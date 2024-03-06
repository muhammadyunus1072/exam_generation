<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Traits\WithDatatable;
use App\Helpers\PermissionHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On; 

class Datatable extends Component
{
    use WithDatatable;

    public $end_date;
    public $start_date;

    protected $listeners = [
        'addFilter',
    ];

    public function onMount()
    {
        $this->sortDirection = 'desc';
        $this->end_date = Carbon::now()->format('Y-m-d');
        $this->start_date = Carbon::now()->subMonths(1)->format('Y-m-d');
    }
    
    #[On('refreshDatatable')] 
    public function refreshDatatable()
    {
        $this->dispatch('$refresh');
    }
    #[On('addFilter')] 
    public function addFilter($filter)
    {
        foreach ($filter as $key => $value) {
            $this->$key = $value;
        }
    }
    public function destroy($id)
    {
        $item = User::find($id);
        $authUser = User::find(Auth::id());
        if (!$authUser->hasPermissionTo("delete users")) {
            return;
        }

        $item->delete();
        $this->dispatch('onSuccessSweetAlert', 'Data has been successfully deleted!');
    }

    public function getColumns(): array
    {
        return [
            [
                'name' => 'Action',
                'sortable' => false,
                'searchable' => false,
                'render' => function ($item) {

                    $authUser = User::find(Auth::id());

                    $editHtml = "";
                    if ($authUser->hasPermissionTo("edit users")) {
                        $editHtml = "<div class='col-auto'>
                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' wire:click=\"\$dispatch('editDetail', { id: '$item->id' })\">
                        <i class='fa fa-edit'></i> Edit
                        </button>
                        </div>";
                    }

                    $destroyHtml = "";
                    if ($authUser->hasPermissionTo("delete users")) {
                        $destroyHtml = "<div class='col-auto'>
                            <form wire:submit.prevent=\"destroy('$item->id')\">"
                                . method_field('DELETE') . csrf_field() .
                                "<button type='submit' class='btn btn-danger btn-sm'
                                    onclick=\"return confirm('Delete Data?')\">
                                    <i class='fa fa-trash mr-2'></i>Delete
                                </button>
                            </form>
                        </div>
                        ";
                    }

                    $html = "<div class='row'>
                        $editHtml $destroyHtml 
                    </div>";

                    return $html;
                },
            ],
            [
                'key' => 'name',
                'name' => 'Name',
                'render' => function ($item) {
                    return $item->name;
                }
            ],
            [
                'key' => 'email',
                'name' => 'Email',
                'render' => function ($item) {
                    return $item->email;
                }
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Role',
                'render' => function ($item) {
                    return User::find($item->id)->getRoleNames()[0];
                }
            ],
        ];
    }

    public function getQuery(): Builder
    {
        $start_date = $this->start_date . " 00:00:00";
        $end_date = $this->end_date . " 23:59:59";

        return User::query();
    }

    public function getView(): string
    {
        return 'livewire.user.datatable';
    }
}
