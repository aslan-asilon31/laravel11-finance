<?php

namespace App\Livewire\Admin\PenilaianAsesmen\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PenilaianAsesmenForm extends Form
{

    public string|null $id = null;
    public string|null $judul = null;
    public string|null $deskripsi = null;
    public string|null $durasi = null;
    public string|null $tgl_mulai = null;
    public string|null $tgl_selesai = null;


    public function rules(): array
    {
        return [
            'masterForm.id' => 'nullable|string',
            'masterForm.asesmen.judul' => 'nullable|string',
            'masterForm.asesmen.deskripsi' => 'nullable|string',
            'masterForm.asesmen.durasi' => 'nullable|string',
            'masterForm.asesmen.tgl_mulai' => 'required|date',
            'masterForm.asesmen.tgl_selesai' => 'required|date|after:tgl_mulai',
            'masterForm.detail_pengguna_asesmens.jawaban' => 'nullable|string',
        
        ];
    }

    public function attributes(): array
    {
        return [
            'id' => 'ID',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
            'durasi' => 'Durasi',
            'tgl_mulai' => 'Tanggal Mulai',
            'tgl_selesai' => 'Tanggal Selesai',
            'masterForm.detail_pengguna_asesmens.jawaban' => 'Jawaban',
        ];
    }

}
