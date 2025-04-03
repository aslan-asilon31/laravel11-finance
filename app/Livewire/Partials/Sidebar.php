<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Asesmen;
use Mary\Traits\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Url;


class Sidebar extends Component
{

    public string $title = '';
    public $id ;
    public $lang ;

    #[On('change-language')]
    public function mount()
    {
        App::setLocale(App::getLocale());

    }

    #[On('change-language')]
    public function changesLanguage($title)
    {
        $this->lang = $title;
        App::setLocale($this->lang);

    }

    public function render()
    {
        return view('livewire.partials.sidebar')
        ->title($this->title);
    }

}
