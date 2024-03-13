<?php

namespace App\Livewire\Auth;

use App\Helpers\Alert;
use App\Repositories\Account\UserRepository;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;

class Login extends Component
{
    #[Validate('required', message: 'Email Harus Diisi', onUpdate: false)]
    #[Validate('email', message: "Format Email Tidak Sesuai", onUpdate: false)]
    public $email;

    #[Validate('required', message: 'Password Harus Diisi', onUpdate: false)]
    public $password;

    #[Validate('required', message: 'Captcha Harus Diisi', onUpdate: false)]
    #[Validate('captcha', message: 'Captcha Tidak Sesuai', onUpdate: false)]
    public $captcha;

    public function store()
    {
        $this->dispatch('reload-captcha');
        $this->validate();

        $user = UserRepository::findByEmail($this->email);
        if (empty($user)) {
            Alert::fail($this, 'Login Gagal', 'Email Belum Terdaftar');
            return;
        }

        if (!Hash::check($this->password, $user->password)) {
            Alert::fail($this, 'Login Gagal', 'Password Tidak Sesuai');
            return;
        }

        if (empty($user->email_verified_at) && config('template.email_verification_route')) {
            $user->sendEmailVerificationNotification();
            $this->redirectRoute('verification.index', ['email' => $this->email]);
            return;
        }

        Auth::loginUsingId($user->id);
        $this->redirectRoute('dashboard.index');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
