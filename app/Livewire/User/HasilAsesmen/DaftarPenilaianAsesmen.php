<?php

namespace App\Livewire\Admin\PenilaianAsesmen;

use Livewire\Component;
use Livewire\Attributes\Title;

class DaftarPenilaianAsesmen extends Component
{
    protected $title = 'asesmens';
    public string $url = '/asesmen';


    #[Title('Daftar Penilaian Asesmen')] 
    public function render()
    {
        return view('livewire.admin.penilaian-asesmen.daftar-penilaian-asesmen');
    }
}
