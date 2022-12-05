<?php

namespace App\Http\Livewire;

use App\Models\Tache;
use Livewire\Component;

class TachesTable extends Component
{
    public $checklist;


    public function render()
    {
        $taches = $this->checklist->taches()->orderBy('position')->get();

        return view('livewire.taches-table', compact('taches'));
    }

    public function updateTaskOrder($taches){

        // dd($taches);
        foreach ($taches as $tache){
            Tache::find($tache['value'])->update(['position' => $tache['order']]);
        }
    }
}
