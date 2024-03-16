<?php

namespace App\Livewire\Documentation;

use Exception;
use App\Helpers\Alert;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use App\Repositories\Documentation\DocumentationRepository;


class Filter extends Component
{
    #[Validate('required', message: 'Nama Harus Diisi', onUpdate: false)]
    public $name = '';
    
    #[Validate('required', message: 'Content Harus Diisi', onUpdate: false)]
    public $content = '';
    public $objId;

    public function save()
    {   
        $this->dispatch('consoleLog', $this->content);
        $this->validate();

        $validatedData = [
            'name' => $this->name,
            'content' => $this->content,
        ];

        try {
            DB::beginTransaction();
            if ($this->objId) {
                DocumentationRepository::update($this->objId, $validatedData);
            } else {
                DocumentationRepository::create($validatedData);
            }
            DB::commit();

            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Dokumentasi Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
            $this->dispatch('refreshDatatable');
            
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function resetInput(){
        $this->reset();
    }

    #[On('editDetail')]
    public function editDetail($id)
    {
        if ($id) {
            $documentation = DocumentationRepository::find($id);
            if ($documentation) {
                $this->objId = $documentation->id;
                $this->name = $documentation->name;
                $this->content = $documentation->content;

                $this->dispatch('editContent', content : $this->content);
            }
        }
    }

    public function render()
    {
        return view('livewire.documentation.filter');
    }
}
