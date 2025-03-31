<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\Asesmen;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;

use App\Models\Pengguna; // Model pengguna
use Illuminate\Http\JsonResponse; // Untuk tipe respons JSON
use Illuminate\Http\Request; // Untuk Request
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // Untuk pengecualian validasi
use App\Livewire\Auth\Forms\LoginForm;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{

    public  $title = "Halaman Login";
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



        // $user = Pengguna::where('surel', $validatedLoginForm['surel'])->first();

        // if ($user && password_verify($validatedLoginForm['sandi'], $user->sandi)) {
                // return redirect()->to('/dasbor');

                if (Auth::attempt(['surel' => $validatedLoginForm['surel'], 'sandi' => $validatedLoginForm['sandi']])) {
                    // Login berhasil
                    return redirect()->intended('dasbor');
                } else {
                    // Login gagal
                    Log::warning('Login failed for:', ['surel' => $validatedLoginForm['surel']]);
                    throw ValidationException::withMessages([
                        'sandi' => ['Surel atau sandi yang Anda masukkan salah.'],
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
