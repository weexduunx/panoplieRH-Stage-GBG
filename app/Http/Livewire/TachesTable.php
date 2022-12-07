<?php

namespace App\Http\Livewire;

use App\Models\Tache;
use Livewire\Component;

class TachesTable extends Component
{
    public $checklist;


    public function render()
    {
        $taches = $this->checklist->taches()->where('user_id', Null)->orderBy('position')->get();

        return view('livewire.taches-table', compact('taches'));
    }

    public function task_up($tache_id)
    {
        $tache = Tache::find($tache_id);
        if ($tache){
            Tache::whereNull('user_id')->where('position', $tache->position - 1)->update([
                'position' => $tache->position
            ]);
            $tache->update(['position' => $tache->position - 1]);
   
        }

    }

    public function task_down($tache_id)
    {
        $tache = Tache::find($tache_id);
        if ($tache){
            Tache::whereNull('user_id')->where('position', $tache->position + 1)->update([
                'position' => $tache->position
            ]);
            $tache->update(['position' => $tache->position + 1]);
   
        }

    }
}
