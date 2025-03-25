<?php

namespace App\Livewire\Asesmen;

use Livewire\Component;
use App\Models\Asesmen;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Mary\Traits\Toast;
use App\Models\Pertanyaan;


class SoalAsesmen extends Component
{
    use Toast;
    public string $title = 'Ujian ';

    public $questions = [];
    public $asesmen =[];
    public $answers = [];
    public $examList = false;
    public $examQuestion = false;
    public $examStarted = false;
    public $examFinished = false;
    public $waktuAsesmen ;
    public $waktuAsesmenMulai;
    public $waktuSekarang;
    public $waktuAsesmenSelesai;
    public $waktuAsesmenBerhentiSebelumSelesai;
    public $waktuAsesmenYangDihabiskan;

    public $questionTimer = 10;
    public $questionTimers = [];

    public $indexJawaban = 0;
    public $pertanyaans;
    public $userId;
    public $asesmenDurasi = 0 ;
    public $pertanyaanId;
    public $hitungPertanyaan = [];
    public $jawaban;


    public $waktuSoalSekarang ;
    public $waktuSoalMulai ;
    public $waktuSoal ;
    public $waktuSoalSelesai ;
    public $waktuSoalBerjalan = 0;
    public $nomorSoal ;
    public $nomorSoalTerakhir ;
    public $currentSoalNow ;
    public $currentSoalTime ;
    public $waktuSoalYangDihabiskan ;
    public $nomorSoalTerakhirHasil ;




    #[\Livewire\Attributes\Locked]
    public string $id = '';


    // #[On('durasi-soal-berjalan-selesai')]
    // public function updatewaktuSoalBerjalan($value)
    // {

    //     session([

    //         'soal-sesi.waktuSoalBerjalan' => $value,
    //     ]);

    // }

    #[On('update-soal-terakhir')]
    public function updateSoalTerakhir()
    {
        $this->nomorSoal = $this->indexJawaban+1;
        session([


            // 'soal-sesi.waktuAsesmenMulai' => $this->waktuAsesmenMulai->format('Y-m-d H:i:s'),
            // 'soal-sesi.waktuAsesmenSelesai' => $this->waktuAsesmenSelesai->format('Y-m-d H:i:s'),

        ]);

    }





    public function mount()
    {

        //  dd(Session());

        $this->pertanyaans = Pertanyaan::where('asesmen_id', $this->id)->get();

        $this->jawaban = array_fill(0, count($this->pertanyaans), '');

        $this->initialize();



        if (Session::has('soal-sesi.soal')) {
            $soalState = Session::get('soal-sesi.soal');

            if (is_array($soalState) && count($soalState) >= 0) {
                $this->jawaban = [];

                foreach ($soalState as $question) {
                    if (isset($question['nomorSoal']) && isset($question['jawaban'])) {
                        $this->indexJawaban = $question['nomorSoal']-1;
                        $this->waktuSoal = $question['durasiSoal'];

                        $this->jawaban[$this->indexJawaban] = $question['jawaban'] ?? '';
                    } else {
                        error_log('Error: Necessary keys (nomorSoal or jawaban) are missing in a question.');
                    }
                }
            } else {
                error_log('Error: Session variable soal-sesi.soal is not an array or is empty.');
            }
        } else {
            error_log('Error: Session variable soal-sesi.soal does not exist.');
        }



    }






    // #[On('asesment-durasi-id')]
    // public function durasiAsesmen($asesmenId)
    // {
    //     $this->id = $asesmenId;
    //     $this->asesmen = Asesmen::where('id', $this->id)->firstOrFail()->toArray();
    //     $this->asesmenDurasi = $this->asesmen['durasi'];
    // }


    public function initialize()
    {

        $this->asesmen = Asesmen::where('id', $this->id)->firstOrFail()->toArray();
        $this->waktuAsesmen = $this->asesmen['durasi'];

        $jam = floor($this->waktuAsesmen / 3600); // Menghitung jam
        $menit = floor(($this->waktuAsesmen % 3600) / 60); // Menghitung menit
        $detik = $this->waktuAsesmen % 60; // Menghitung detik

        $this->waktuAsesmenMulai = now();
        $this->waktuAsesmenSelesai = $this->waktuAsesmenMulai->copy()->addSeconds($this->waktuAsesmen); // Waktu selesai asesmen

        if (!Session::has('soal-sesi.waktuAsesmen')) {
            Session::put('soal-sesi.waktuAsesmen', [
                'jam' => $jam,
                'menit' => $menit,
                'detik' => $detik,
            ]);
            Session::put('soal-sesi.waktuAsesmenMulai', $this->waktuAsesmenMulai->format('Y-m-d H:i:s'));
            Session::put('soal-sesi.waktuAsesmenSelesai', $this->waktuAsesmenSelesai->format('Y-m-d H:i:s'));
        }

        $this->waktuSoalSekarang = now(); // Waktu sekarang untuk soal
        $this->waktuSoalMulai = 30; // Misalkan durasi soal dalam detik (30 detik)
        $this->waktuSoal = $this->pertanyaans[$this->indexJawaban]->durasi;


        // $this->waktuSoal = $this->waktuSoalMulai; // Durasi soal
        $this->waktuSoalSelesai = $this->waktuSoalSekarang->copy()->addSeconds($this->waktuSoal); // Waktu selesai soal



        $this->asesmen = Asesmen::where('id', $this->id)->firstOrFail()->toArray();
        $this->asesmenDurasi = $this->asesmen['durasi'];

    }


    #[On('durasi-soal-selesai')]
    public function durasiSoalSelesai($value)
    {
        if ($this->indexJawaban < count($this->pertanyaans) - 1 ) {
            $this->indexJawaban++;

            if (session()->get('soal-sesi.userId') === $this->userId) {
                session([
                    'soal-sesi.waktuSoalBerjalan' => $value,
                ]);
            }


            // $this->waktuSoalBerjalan = now()->timestamp - $this->waktuSoalSekarang->timestamp;

            return;
        } else {
            $this->redirect('/konfirmasi-selesai', navigate: true);
            return;
        }
    }

    #[On('durasi-soal-selesai')]
    public function nextPage($value)
    {
        $this->waktuSoalBerjalan =$value;
        if (session()->get('soal-sesi.userId') === $this->userId) {
            session([
                'soal-sesi.waktuSoalBerjalan' => $value,
            ]);
        }


    }

    public function soalSelanjutnya()
    {
        $this->currentSoalNow = now();

        if (session()->get('soal-sesi.userId') === $this->userId) {
            session([
                'soal-sesi.waktuSoalBerjalan' => $this->waktuSoalBerjalan,
            ]);
        }

        $pertanyaanId = $this->pertanyaans[$this->indexJawaban]->id;

        // Hitung waktu soal yang telah dihabiskan
        $currentSoalTime = now(); // Waktu saat ini
        $elapsedSoalTime = $currentSoalTime->diffInSeconds($this->currentSoalNow); // Hitung selisih waktu dalam detik


        session()->put('soal-sesi.soal.' . $this->indexJawaban, [
            'pertanyaan_id' => $pertanyaanId,
            'jawaban' => $this->jawaban[$this->indexJawaban],
            'durasiSoal' => $this->waktuSoal,
            'waktuSoalSekarang' => $this->waktuSoalSekarang->format('Y-m-d H:i:s'),
            'waktuSoalSelesai' => $this->waktuSoalSelesai->format('Y-m-d H:i:s'),
            'waktuSoalYangDihabiskan' => $elapsedSoalTime,
            'nomorSoal' => $this->indexJawaban+1,
        ]);

        if ($this->indexJawaban < count($this->pertanyaans) - 1) {
            $this->indexJawaban++;
            $this->waktuSoal = $this->pertanyaans[$this->indexJawaban]->durasi;
            $this->dispatch('start-timers');
        } else {

            // Hitung waktu yang telah dihabiskan
            $currentTime = now(); // Waktu saat ini
            $elapsedTime = $currentTime->diffInSeconds($this->waktuAsesmenMulai); // Hitung selisih waktu dalam detik

            if (isset($this->jawaban[$this->indexJawaban])) {
                session()->put('soal-sesi.soal.' . $this->indexJawaban, $this->jawaban[$this->indexJawaban]);
            }

            session()->put('soal-sesi.soal.' . $this->indexJawaban, [

                'pertanyaan_id' => $pertanyaanId,
                'jawaban' => $this->jawaban[$this->indexJawaban],
                'durasiSoal' => $this->waktuSoal,
                'waktuSoalSekarang' => $this->waktuSoalSekarang->format('Y-m-d H:i:s'),
                'waktuSoalSelesai' => $this->waktuAsesmenSelesai->format('Y-m-d H:i:s'),
                'waktuSoalYangDihabiskan' => $elapsedSoalTime,
                'nomorSoal' => $this->indexJawaban+1,
            ]);

            $this->dispatch('update-soal-terakhir');
            Session::put('soal-sesi.waktuAsesmenYangDihabiskan', $elapsedTime);
            $this->nomorSoalTerakhirHasil = session('soal-sesi.nomorSoalTerakhir');

            // Redirect to confirmation page if it's the last question
            $this->redirect('/konfirmasi-selesai', navigate: true);
        }
    }

    public function soalSebelumnya()
    {
        if ($this->indexJawaban > 0) {
            $this->indexJawaban--;
            // $this->jawaban = session('soal-sesi.jawabanSoalTerakhir', []);
            $this->waktuSoal = $this->pertanyaans[$this->indexJawaban]->durasi;

            if (Session::has('soal-sesi')) {
                $soalState = Session::get('soal-sesi');

                // Memastikan bahwa ada elemen yang sesuai dengan indexJawaban
                if (isset($soalState[$this->indexJawaban])) {
                    // Mengambil nomor soal dan jawaban dari soalState
                    $this->jawaban[$this->indexJawaban] = $soalState[$this->indexJawaban]['jawaban'] ?? '';
                }

            }
            // dd($this->jawaban[$this->indexJawaban]);

        }
    }

    public function confirmStartTest()
    {
        $this->testList = false;
        $this->testQuestion = false;
        $this->testStarted = true;
        $this->testFinished = false;
        $this->testTimer = 3600;

        $this->startTest();
    }

    public function startTest()
    {

        $this->testTimer = 3600;
        $this->testStarted = false;
        $this->testQuestion = true;
        $this->testList = false;
        $this->indexJawaban = 0;
        $this->testFinished = false;
        $this->questionTimers[$this->indexJawaban] = $this->questionTimer;
        $this->dispatch('start-timers');
    }

    #[On('assesmen-selesai')]
    public function finishTest($value)
    {
        session()->put('soal-sesi.nomorSoalTerakhir', $value);
        dd('finish', $value, session('soal-sesi.nomorSoalTerakhir'));
        dd(Session());
    }




    public function render()
    {
        return view('livewire.asesmen.halaman-soal-asesmen', [
            'currentQuestion' => $this->questions[$this->indexJawaban] ?? null, // Ambil soal berdasarkan indeks
        ])
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
}
