<?php

namespace App\Livewire\User1;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\Image;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use App\Livewire\Image\Forms\ImageForm;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Session;

class UserCrud extends Component
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

        $users = User::create([
            'name' => $validatedForm['name'],
            'email' => $validatedForm['email'],
        ]);

        if($users){
            $this->success('user berhasil ditambahkan');
            $this->dispatch('user-created');
        }else{
            $this->success('user gagal ditambahkan');
        }

    }

    public function edit()
    {
        $user = User::findOrFail($this->id);
        $this->masterForm->name = $user->name;
        $this->masterForm->email = $user->email;
    }

    public function update()
    {
        $validatedForm = $this->validate(
            $this->masterForm->rules(),
            [],
            $this->masterForm->attributes()
        )['masterForm'];
        
        $user = User::findOrFail($this->id);

        $updated = $user->update($validatedForm);
    
        if ($updated) {
            $this->success('User berhasil diupdate');
            $this->dispatch('user-updated');
        } else {
            $this->error('User gagal diupdate');
        }

    }

    public function render()
    {
        return view('livewire.user1.user-crud');
    }
}
