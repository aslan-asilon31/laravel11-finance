<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\Asesmen;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;

use App\Models\User; // Model User
use Illuminate\Http\JsonResponse; // Untuk tipe respons JSON
use Illuminate\Http\Request; // Untuk Request
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // Untuk pengecualian validasi
use App\Livewire\Auth\Forms\LoginForm;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{

    public  $title = "Halaman Login";
    public  $user;
    public  $email;
    public  $password;



    public LoginForm $loginForm;

    public function mount()
    {
      if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->intended('dasbor');
      }
    }


    public function login()
    {
        $validatedLoginForm = $this->validate(
            $this->loginForm->rules(),
            [],
            $this->loginForm->attributes()
          )['loginForm'] ?? [];


        $user = User::where('email', $validatedLoginForm['email'])->first();

        if ($user && password_verify($validatedLoginForm['password'], $user->password)) {
                // return redirect()->to('/dasbor');

                // if (Auth::attempt(['email' => $validatedLoginForm['email'], 'password' => $validatedLoginForm['password']])) {
                    // Login berhasil
                    return 'success';
                    // return redirect()->intended('dasbor');
                } else {
                    // Login gagal
                    Log::warning('Login failed for:', ['email' => $validatedLoginForm['email']]);
                    throw ValidationException::withMessages([
                        'password' => ['email atau password yang Anda masukkan salah.'],
                    ]);
                }
        }


    #[Title('Halaman Login')]
    public function render()
    {

        return view('livewire.auth.login')
        ->layout('components.layouts.app_auth');
    }
}
