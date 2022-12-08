<?php

namespace App\Http\Livewire;

use App\Models\Checklist;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HeaderTotalCount extends Component
{
    public $checklist_group_id;

    protected $listeners = ['task_complete' => 'render'];
    
    public function render()
    {
        $checklists = Checklist::where('checklist_group_id', $this->checklist_group_id)
        ->whereNull('user_id')
        ->withCount(['taches' => function($query){
            $query->whereNull('user_id');
        }])
        ->withCount(['user_taches' => function($query){
            $query->whereNotNull('completed_at');
        }])
        ->get();


        return view('livewire.header-total-count', compact('checklists'));
    }
}
