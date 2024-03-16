<?php

namespace App\Livewire\Documentation;

use Exception;
use App\Helpers\Alert;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use App\Repositories\Documentation\DocumentationRepository;


class Show extends Component
{
    public $documentation_id;
    public $documentation_content;
    public $documentation;
    public $documentation_menus;

    public function mount(){
        $this->documentation_menus = DocumentationRepository::getIdAndNames();
        if($this->documentation_id){
            $this->show($this->documentation_id);
        }else{
            $documentation = DocumentationRepository::first();
            $this->documentation_id = $documentation->id;
            $this->documentation_content = $documentation->content;
        }
    }

    public function show($id){
        $documentation = DocumentationRepository::find($id);
        $this->documentation_id = $documentation->id;
        $this->documentation_content = $documentation->content;

        $this->dispatch('highlightCode');
    }
    public function render()
    {
        return view('livewire.documentation.show');
    }
}
