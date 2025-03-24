<?php

namespace App\Livewire\Asesmen;

use Livewire\Component;
use App\Models\Asesmen;
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
    public $waktuSoalTerakhir ;
    public $waktuSoalBerjalan = 0;
    public $nomorSoal ;
    public $nomorSoalTerakhir ;
    public $nomorSoalTerakhirHasil ;

    public $soalSelanjutnya = false ;



    #[\Livewire\Attributes\Locked]
    public string $id = '';


    #[On('durasi-soal-berjalan-selesai')]
    public function updatewaktuSoalBerjalan($value)
    {

        session([

            'soal-sesi.waktuSoalBerjalan' => $value,
        ]);

    }

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

            //  session()->flush();

    //  session()->forget('soal-sesi.userId');
    //  session()->forget('soal-sesi.asesmenId');
    //  session()->forget('soal-sesi.pertanyaanId');
    //  session()->forget('soal-sesi.waktuAsesmenMulai');


    //  Session::forget('soal-sesi');
    //  Session::forget('soal-sesi');
    //  Session::forget('waktuSoalSekarang');
    //  Session::forget('waktuSoal');
    //  Session::forget('waktuSoalSelesai');
    //  Session::forget('waktuSoalBerjalan');
    //  dd(Session());

    $this->pertanyaans = Pertanyaan::where('asesmen_id', $this->id)->get();

    $this->jawaban = array_fill(0, count($this->pertanyaans), '');

    $this->initialize();



    if (Session::has('soal-sesi')) {
        $soalState = Session::get('soal-sesi');


        // Memastikan bahwa ada setidaknya satu elemen dalam soalState
        if (isset($soalState[0])) {
            // Mengatur index jawaban berdasarkan nomor soal dari elemen pertama
            $this->indexJawaban = $soalState[0]['nomorSoal'] ?? 0;
            // Mengatur jawaban untuk soal yang sesuai dengan nomor soal
            $this->jawaban[$this->indexJawaban] = $soalState[0]['jawaban'] ?? '';
        }

        // Mengisi jawaban untuk semua soal yang ada dalam soalState
        for ($i = 0; $i < count($soalState); $i++) {
            if (isset($soalState[$i])) {
                // Mengisi jawaban berdasarkan nomor soal
                $nomorSoal = $soalState[$i]['nomorSoal'] ?? null;
                if ($nomorSoal !== null) {
                    $this->jawaban[$nomorSoal] = $soalState[$i]['jawaban'] ?? '';
                }
            }
        }

        // dd($nomorSoal);
        $this->indexJawaban = $nomorSoal;
        // $this->jawaban[$this->indexJawaban] = session('soal-sesi.jawabanSoalTerakhir', []);


        // $this->indexJawaban = $soalState[0]['nomorSoal'] ?? 0;
        // $this->jawaban[$this->indexJawaban] = $soalState[0]['jawaban'] ?? '';
        // dd('tes');

        // $this->currentQuestionIndex = $soalState['currentQuestionIndex'];
        // $this->answers = $soalState['answers'];
    } else {
        // $this->answers = array_fill(0, count($this->questions), '');
    }

    // dd($this->jawaban[$this->indexJawaban]);




     }





    #[On('asesment-durasi-id')]
    public function durasiAsesmen($asesmenId)
    {
        $this->id = $asesmenId;
        $this->asesmen = Asesmen::where('id', $this->id)->firstOrFail()->toArray();
        $this->asesmenDurasi = $this->asesmen['durasi'];
    }


    public function initialize()
    {
        $userId = auth()->id() ?? 'eafe4ec3-2e7d-4147-9dbe-754a79ff7740';

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
        $this->waktuSoal = $this->waktuSoalMulai; // Durasi soal
        $this->waktuSoalSelesai = $this->waktuSoalSekarang->copy()->addSeconds($this->waktuSoal); // Waktu selesai soal


        $this->waktuSoal = $this->pertanyaans[$this->indexJawaban]->id;




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


            $this->waktuSoalBerjalan = now()->timestamp - $this->waktuSoalSekarang->timestamp;

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

    public function nextQuestion()
    {
        if (session()->get('soal-sesi.userId') === $this->userId) {
            session([
                'soal-sesi.waktuSoalBerjalan' => $this->waktuSoalBerjalan,
            ]);
        }

        $pertanyaanId = $this->pertanyaans[$this->indexJawaban]->id;

        $this->dispatch('hentikan-waktu-soal-berjalan');

        session()->put('soal-sesi.' . $this->indexJawaban, [

            'user_id' => $this->userId,
            'asesmen_id' => $this->id,
            'pertanyaan_id' => $pertanyaanId,
            'jawaban' => $this->jawaban[$this->indexJawaban],
            'waktuSoalSekarang' => $this->waktuSoalSekarang->format('Y-m-d H:i:s'),
            'waktuSoalSelesai' => $this->waktuSoalSelesai->format('Y-m-d H:i:s'),
            'nomorSoal' => $this->indexJawaban,
        ]);



        if ($this->indexJawaban < count($this->pertanyaans) - 1) {
            $this->indexJawaban++;


            $this->dispatch('start-timers');
        } else {


                // Hitung waktu yang telah dihabiskan
                $currentTime = now(); // Waktu saat ini
                $elapsedTime = $currentTime->diffInSeconds($this->waktuAsesmenMulai); // Hitung selisih waktu dalam detik


            if (isset($this->jawaban[$this->indexJawaban])) {
                session()->put('soal-sesi.jawaban.' . $this->indexJawaban, $this->jawaban[$this->indexJawaban]);
            }

            session()->put('soal-sesi.' . $this->indexJawaban, [

                'user_id' => $this->userId,
                'asesmen_id' => $this->id,
                'pertanyaan_id' => $pertanyaanId,
                'jawaban' => $this->jawaban[$this->indexJawaban],
                'waktuSoalSekarang' => $this->waktuSoalSekarang->format('Y-m-d H:i:s'),
                'waktuSoalSelesai' => $this->waktuAsesmenSelesai->format('Y-m-d H:i:s'),
                'waktuAsesmenYangDihabiskan' => $elapsedTime,
                'nomorSoal' => $this->indexJawaban,

            ]);

            $this->dispatch('update-soal-terakhir');

            $this->nomorSoalTerakhirHasil = session('soal-sesi.nomorSoalTerakhir');

            // Redirect to confirmation page if it's the last question
            $this->redirect('/konfirmasi-selesai', navigate: true);
        }
    }

    public function previousQuestion()
    {
        if ($this->indexJawaban > 0) {
            $this->indexJawaban--;
            // $this->jawaban = session('soal-sesi.jawabanSoalTerakhir', []);


            if (Session::has('soal-sesi')) {
                $soalState = Session::get('soal-sesi');

                // Memastikan bahwa ada elemen yang sesuai dengan indexJawaban
                if (isset($soalState[$this->indexJawaban])) {
                    // Mengambil nomor soal dan jawaban dari soalState
                    $this->jawaban[$this->indexJawaban] = $soalState[$this->indexJawaban]['jawaban'] ?? '';
                }
            }

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



    public function examNow()
    {

        $this->testStarted = false;
        $this->testQuestion = true;
        $this->testList = false;
        $this->testFinished = false;
        $this->testTimer = 3600;

        $this->questionTimers[$this->indexJawaban] = $this->questionTimer;

        $this->dispatch('start-timers');
        return;
    }

    #[On('jawaban-belum-diisi')]
    public function jawabanBelumDiisi()
    {

        if ($this->indexJawaban < count($this->pertanyaans) - 1 ) {
            $this->indexJawaban++;
            return;

        } else {
            $this->redirect('/konfirmasi-selesai', navigate: true);
            return;
        }


    }






    public function finishTest()
    {
        dd('finish');
        $this->testFinished = true;
        $this->testStarted = false;
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
