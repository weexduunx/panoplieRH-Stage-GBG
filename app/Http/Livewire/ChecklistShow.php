<?php

namespace App\Http\Livewire;

use App\Models\Tache;
use Livewire\Component;

class ChecklistShow extends Component
{
    public $checklist;
    public $opened_tasks = [];
    public $completed_tasks = [];



    public function mount()
    {
        $this->completed_tasks = Tache::where('checklist_id', $this->checklist->id)
            ->where('user_id', auth()->id())
            ->whereNotNull('completed_at')
            ->pluck('tache_id')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.checklist-show');
    }

    public function toggle_task($tache_id)
    {
        if(in_array($tache_id, $this->opened_tasks)){

            $this->opened_tasks = array_diff($this->opened_tasks, [$tache_id]);
        }
        else{
            $this->opened_tasks[] = $tache_id;
        }
    }

    public function taches_completes($tache_id)
    {

        $tache = Tache::find($tache_id);
        if($tache){
            $user_tache = Tache::where('tache_id', $tache_id)->first();
            if ($user_tache){
                if(is_null($user_tache->completed_at)){
                    $user_tache->update(['completed_at' => now()]);
                }

            }else{
                $user_tache = $tache->replicate();
                $user_tache['user_id'] = auth()->id();
                $user_tache['tache_id'] = $tache_id;
                $user_tache['completed_at'] = now();
                $user_tache->save();
            }
        }
    }
}
