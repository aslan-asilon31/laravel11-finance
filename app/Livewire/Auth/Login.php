<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Authentication passed...
            return redirect()->to('/role');
        } else {
            // Login failed
            throw ValidationException::withMessages([
                'email' => ['Email or password is incorrect.'],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.login')
        ->layout('components.layouts.app_auth');

    }
}

