<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Helpers\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    #[Validate('required', message: 'Nama Harus Diisi', onUpdate: false)]
    public $name;

    #[Validate('required', message: 'Email Harus Diisi', onUpdate: false)]
    #[Validate('email', message: "Format Email Tidak Sesuai", onUpdate: false)]
    public $email;

    #[Validate('required', message: 'Password Harus Diisi', onUpdate: false)]
    public $password;

    #[Validate('required', message: 'Ketik Ulang Password Harus Diisi', onUpdate: false)]
    public $retypePassword;

    #[Validate('required', message: 'Captcha Harus Diisi', onUpdate: false)]
    #[Validate('captcha', message: 'Captcha Tidak Sesuai', onUpdate: false)]
    public $captcha;

    public function store()
    {
        $this->dispatch('reload-captcha');
        $this->validate();

        if ($this->password != $this->retypePassword) {
            Alert::fail($this, 'Register Gagal', 'Pengetikan Ulang Password Tidak Sama');
            return;
        }

        $user = User::where("email", "=", $this->email)->first();
        if (!empty($user)) {
            Alert::fail($this, 'Register Gagal', 'Email Sudah Digunakan');
            return;
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        $user->assignRole(config('template.registration_default_role'));

        if (config('template.email_verification_feature')) {
            $user->sendEmailVerificationNotification();
            $this->redirectRoute('verification.index', ['email' => $this->email]);
            return;
        }

        Auth::loginUsingId($user->id);
        $this->redirectRoute('login');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
