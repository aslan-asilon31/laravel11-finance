<?php

namespace App\Livewire\FromSub\Image;

use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\Image;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use App\Livewire\Image\Forms\ImageForm;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Session;

class ImageCrud extends Component
{


    /*
    Buat CRUD menggunakan
    - Locked Properties
    - URL Query Parameters
    - Forms
    - Validation
    */

    use \Mary\Traits\Toast;


    #[Locked]
    public $id;

    public ImageForm $masterForm;

    public function mount()
    {
        if ($this->id) {
            $this->edit();
        } else {
            $this->create();
        }
    }

    public function create()
    {
        $this->masterForm->reset();
    }

    public function store()
    {
        $validatedForm = $this->validate(
            $this->masterForm->rules(),
            [],
            $this->masterForm->attributes()
        )['masterForm'];

        $images = Image::create([
            'url' => $validatedForm['url'],
            'imageable_id' => $validatedForm['imageable_id'],
            'imageable_type' => $validatedForm['imageable_type'],
        ]);

        if ($images) {
            $this->success('Image berhasil ditambahkan');
            $this->dispatch('Image-created');
        } else {
            $this->success('Image gagal ditambahkan');
        }
    }

    public function edit()
    {
        $image = Image::findOrFail($this->id);
        $this->masterForm->url = $image->url;
        $this->masterForm->imageable_id = $image->imageable_id;
        $this->masterForm->imageable_url = $image->imageable_url;
    }

    public function update()
    {
        $validatedForm = $this->validate(
            $this->masterForm->rules(),
            [],
            $this->masterForm->attributes()
        )['masterForm'];

        $image = Image::findOrFail($this->id);

        $updated = $image->update($validatedForm);

        if ($updated) {
            $this->success('Image berhasil diupdate');
            $this->dispatch('image-updated');
        } else {
            $this->error('Image gagal diupdate');
        }
    }

    public function render()
    {
        return view('livewire.image.image-crud')
            ->layout('components.layouts.app_visitor');
    }
}
