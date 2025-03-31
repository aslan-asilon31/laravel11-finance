<?php

namespace App\Livewire\Admin\PenilaianAsesmen;

use App\Livewire\Admin\PenilaianAsesmen\Forms\PenilaianAsesmenForm;
use Livewire\Component;
use App\Models\Pengguna;
use App\Models\Asesmen;
use App\Models\PenggunaAsesmen;
use App\Models\DetailPenggunaAsesmen;
use Illuminate\Support\Facades\DB;

class PenilaianAsesmenCrud extends Component
{
  public function render()
  {
    return view('livewire.admin.penilaian-asesmen.penilaian-crud')
      ->title($this->title);
  }

  public $asesmen = [];
  public $userId;
  public $asesmenId;
  public $userName;
  public $userEmail;
  public $pertanyaanId;
  public $ActivePenggunaAsesmens=[];

  use \Livewire\WithFileUploads;
  // use \App\Helpers\Permission\Traits\WithPermission;
  use \Mary\Traits\Toast;

  public PenilaianAsesmenForm $masterForm;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'asesmen';

  #[\Livewire\Attributes\Locked]
  public string $title = 'Asesmen';

  #[\Livewire\Attributes\Locked]
  public string $url = '/asesmen';

  #[\Livewire\Attributes\Locked]
  public string $id = '';

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  public array $options = [];

  public $asesmens= [];
  public $masterPengguna;
  public $asesmen_id;
  public $asesmenDurasi = 0;

  public $questionTimer;
  public $questionTimers = [];

  public $user = [];


  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\Pengguna::class;


  public function mount()
  {
    $this->initialize();
    if ($this->id && $this->readonly) {
      $this->title .= ' (Show)';
      $this->show();
    } else {
      $this->title .= ' (Edit)';

      $this->edit();
    }
  }

  public function initialize()
  {
    \Carbon\Carbon::setLocale('id');

    $this->userId = auth()->id() ?? 'eafe4ec3-2e7d-4147-9dbe-754a79ff7740';
    $this->user = Pengguna::where('id', $this->userId)->firstOrFail()->toArray();
    $this->userName = $this->user['nama'];
    $this->userEmail = $this->user['surel'];



    $this->ActivePenggunaAsesmens = PenggunaAsesmen::with([
      'pengguna',
      'asesmen',
      'detail_pengguna_asesmens',
      'asesmen.pertanyaans',

    ])
    ->where('pengguna_asesmens.pengguna_id', $this->userId)
    ->orderBy('tgl_dibuat', 'desc')
    ->firstOrFail()
    ->toArray();
    $this->masterForm->fill($this->ActivePenggunaAsesmens);

    $this->asesmenId = $this->ActivePenggunaAsesmens['asesmen']['id'] ?? null;


    $this->asesmen = Asesmen::where('id', $this->asesmenId)->firstOrFail()->toArray();
    $this->asesmenDurasi = $this->ActivePenggunaAsesmens['asesmen']['durasi'];

    $tglMulai = \Carbon\Carbon::parse($this->asesmen['tgl_mulai']);
    $tglSelesai = \Carbon\Carbon::parse($this->asesmen['tgl_selesai']);

    // Menyimpan hasil perhitungan ke dalam variabel untuk digunakan di view
    $durasi = $tglMulai->diff($tglSelesai);
    $this->asesmenDurasi =  $durasi->format('%h jam %i menit %s detik');



  }

  public function create()
  {
    // $this->permission($this->basePageName.'-create');

    $this->masterForm->reset();
  }

  public function store()
  {
    // $this->permission($this->basePageName.'-create');

    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['id'] = str($validatedForm['name'])->slug('_');

      $validatedForm['created_by'] = auth()->user()->username;
      $validatedForm['updated_by'] = auth()->user()->username;

      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();

      $this->create();
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Data failed to store: ' . $th->getMessage());
      $this->error('Data failed to store');
    }
  }

  public function show()
  {
    // $this->permission($this->basePageName.'-show');

    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);

  }

  public function edit()
  {


    $this->ActivePenggunaAsesmens = PenggunaAsesmen::with([
      'pengguna',
      'asesmen',
      'detail_pengguna_asesmens',
      'asesmen.pertanyaans',

    ])
    ->where('pengguna_asesmens.pengguna_id', $this->userId)
    ->orderBy('tgl_dibuat', 'desc')
    ->firstOrFail()
    ->toArray();
    $this->masterForm->fill($this->ActivePenggunaAsesmens);

    // dd($this->ActivePenggunaAsesmens);

  }

  public function update()
  {
      // Validate the input data
      $this->validate([
          'ActivePenggunaAsesmens.detail_pengguna_asesmens.*.jawaban' => 'nullable|string|max:1000', // Adjust validation rules as needed
          'ActivePenggunaAsesmens.asesmen_id' => 'required|exists:asesmens,id', // Ensure asesmen_id is valid
      ]);

      // Begin a database transaction
      DB::beginTransaction();
      try {
          // Update the main PenggunaAsesmen record
          $userAsesmen = PenggunaAsesmen::findOrFail($this->ActivePenggunaAsesmens['id']);
          $userAsesmen->update([
              // Update any necessary fields here
              // Example: 'status' => 'updated',
          ]);

          // Update each detail_pengguna_asesmen record
            foreach ($this->ActivePenggunaAsesmens['detail_pengguna_asesmens'] as $detail) {
              $detailPenggunaAsesmen = DetailPenggunaAsesmen::findOrFail($detail['id']);
              $detailPenggunaAsesmen->update([
                      'poin' => $detail['poin'],
                  ]);
            }

          // Commit the transaction
          DB::commit();

          // Provide feedback to the user
          $this->success('Berhasil perbaharui data.');
          session()->flash('message', 'Berhasil perbaharui data.');

          // Optionally redirect or refresh the view
          // return redirect()->route('your.route.name'); // Adjust the route as necessary
      } catch (\Exception $e) {
          // Rollback the transaction in case of error
          DB::rollBack();
          // Handle the error (log it, show a message, etc.)
          $this->error('gagal perbaharui data.'. $e->getMessage());

          session()->flash('error', 'Failed to update data: ' . $e->getMessage());
      }
  }


  public function delete()
  {
    // $this->permission($this->basePageName.'-delete');

    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been deleted');
      $this->redirect($this->url, true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }


}
