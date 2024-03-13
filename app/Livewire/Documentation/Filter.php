<?php

namespace App\Livewire\Documentation;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Alert;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Documentation;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;


class Filter extends Component
{
    public $name = '';
    public $url = '';
    public $content = '';

    public $is_edit = false;

    public function save()
    {   
        $this->dispatch('consoleLog', $this->content);
        // $validated = Validator::make(
        //     // Data to validate...
        //     [
        //         'name' => $this->name, 
        //         'url' => $this->url,
        //     ],
        //     [
        //         'name' => 'required', 
        //         'url' => 'required|unique:documentations',
        //     ],
        //     )->validate();

        // if ($validated) {
        //     $documentation = New Documentation();
        //     $documentation->name = $validated['name'];
        //     $documentation->url = $validated['url'];
        //     $documentation->content = 'Content';
        //     $documentation->save();

        //     Alert::success($this, 'Berhasil', 'Dokumentasi Berhasil Disimpan');
        // }
        // $this->reset();
    }

    public function resetInput(){
        $this->reset();
    }

    public function updatedName($value)
    {
        $this->url = strtolower(preg_replace('/\s+/', '_', $value));
    }
    public function updatedUrl($value)
    {
        $this->url = strtolower(preg_replace('/\s+/', '_', $value));
    }

    #[On('editDetail')]
    public function editDetail($id)
    {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $this->user_id = $user->id;
                $this->name = $user->name;
                $this->email = $user->email;
                $this->password = '';
                $this->is_edit = true;
                $this->dispatch('initSelect2');
                $this->dispatch('addSelect2Role', role: $user->getRoleNames());
            }
        }
    }

    public function render()
    {
        return view('livewire.documentation.filter');
    }
}
