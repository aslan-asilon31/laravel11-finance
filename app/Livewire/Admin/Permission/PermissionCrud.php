<?php

namespace App\Livewire\Admin\Permission;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Livewire\Component;
use App\Livewire\Admin\Permission\Forms\PermissionForm;

class PermissionCrud extends Component
{
    public PermissionForm $masterForm;


    public function render()
    {
        return view('livewire.admin.Permission.Permission-crud');
    }

  use \Livewire\WithFileUploads;
  //   use \App\Helpers\ImageUpload\Traits\WithImageUpload;
     use \App\Helpers\Table\Traits\WithTable;
    use \Mary\Traits\Toast;


    #[\Livewire\Attributes\Locked]
    private string $basePageName = 'role';

    #[\Livewire\Attributes\Locked]
    public string $title = 'Role';

    #[\Livewire\Attributes\Locked]
    public string $url = '/role';



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

    #[\Livewire\Attributes\Locked]
    protected $masterModel = \App\Models\Permission::class;


    public function mount()
    {

      if ($this->id && $this->readonly) {
        $this->title .= ' (Show)';
        $this->show();
      } else if ($this->id) {
        $this->title .= ' (Edit)';
        $this->edit();
      } else {
        $this->title .= ' (Create)';
        $this->create();
      }
      $this->initialize();
    }

    public function initialize()
    {

    }

    public function create()
    {
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
      $this->permission($this->basePageName.'-show');

      $this->isReadonly = true;
      $this->isDisabled = true;
      $masterData = $this->masterModel::findOrFail($this->id);
      $this->masterForm->fill($masterData);
    }

    public function edit()
    {
      $this->permission($this->basePageName.'-update');

      $masterData = $this->masterModel::findOrFail($this->id);
      $this->masterForm->fill($masterData);
    }

    public function update()
    {
      $this->permission($this->basePageName.'-update');

      $validatedForm = $this->validate(
        $this->masterForm->rules(),
        [],
        $this->masterForm->attributes()
      )['masterForm'];

      $masterData = $this->masterModel::findOrFail($this->id);

      \Illuminate\Support\Facades\DB::beginTransaction();
      try {

        $validatedForm['id'] = str($validatedForm['name'])->slug('_');
        $validatedForm['updated_by'] = auth()->user()->username;


        $masterData->update($validatedForm);

        \Illuminate\Support\Facades\DB::commit();

        $this->success('Data has been updated');
      } catch (\Throwable $th) {
        \Illuminate\Support\Facades\DB::rollBack();
        $this->error('Data failed to update');
      }
    }

    public function delete()
    {
      $this->permission($this->basePageName.'-delete');

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
