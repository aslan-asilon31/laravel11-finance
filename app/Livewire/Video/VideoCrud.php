<?php

namespace App\Livewire\Video;
use Livewire\Attributes\Layout;
use App\Models\Video;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use App\Livewire\Video\Forms\VideoForm;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Session;

class VideoCrud extends Component
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

    public VideoForm $masterForm;

    public function mount()
    {
       if($this->id){
        $this->edit();
       }else{
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

        $videos = Video::create([
            'title' => $validatedForm['title'],
            'url' => $validatedForm['url'],
        ]);

        if($videos){
            $this->success('Video berhasil ditambahkan');
            $this->dispatch('video-created');
        }else{
            $this->success('Video gagal ditambahkan');
        }

    }

    public function edit()
    {
        $video = Video::findOrFail($this->id);
        $this->masterForm->title = $video->title;
        $this->masterForm->url = $video->url;
    }

    public function update()
    {
        $validatedForm = $this->validate(
            $this->masterForm->rules(),
            [],
            $this->masterForm->attributes()
        )['masterForm'];
        
        $video = Video::findOrFail($this->id);

        $updated = $video->update($validatedForm);
    
        if ($updated) {
            $this->success('Video berhasil diupdate');
            $this->dispatch('video-updated');
        } else {
            $this->error('Video gagal diupdate');
        }

    }

    public function render()
    {
        return view('livewire.product.video-crud')
        ->layout('components.layouts.app_visitor');
    }
}
