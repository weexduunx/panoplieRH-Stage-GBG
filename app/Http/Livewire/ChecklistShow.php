<?php

namespace App\Http\Livewire;

use App\Models\Tache;
use Livewire\Component;

class ChecklistShow extends Component
{
    public $checklist;
    public $opened_tasks = [];
    public $completed_tasks = [];
    public ?Tache $current_task;



    public function mount()
    {
        $this->completed_tasks = Tache::where('checklist_id', $this->checklist->id)
            ->where('user_id', auth()->id())
            ->whereNotNull('completed_at')
            ->pluck('tache_id')
            ->toArray();

            $this->current_task = NULL;
    }

    public function render()
    {
        return view('livewire.checklist-show');
    }

    public function toggle_task($tache_id)
    {
       
        if(in_array($tache_id, $this->opened_tasks)){

            $this->opened_tasks = array_diff($this->opened_tasks, [$tache_id]);
            $this->current_task = NULL;
        }
        else{
            $this->opened_tasks[] = $tache_id;
            $this->current_task = Tache::where('user_id', auth()->id())
                ->where('tache_id', $tache_id)
                ->first();

                if(!$this->current_task){
                    $task = Tache::find($tache_id);
                    $this->current_task = $task->replicate();
                    $this->current_task['user_id'] = auth()->id();
                    $this->current_task['tache_id'] = $tache_id;
                    $this->current_task->save();

                }
        }
    }

    public function taches_completes($tache_id)
    {

        $tache = Tache::find($tache_id);
        if($tache){
            $user_tache = Tache::where('tache_id', $tache_id)
                ->where('user_id', auth()->id())
                ->first();
            if ($user_tache){
                if(is_null($user_tache->completed_at)){
                    $user_tache->update(['completed_at' => now()]);
                    $this->completed_tasks[] = $tache_id;
                    $this->emit('task_complete',  $tache_id, $tache->checklist_id);
                } else {
                    // $user_tache->delete();
                    $user_tache->update(['completed_at' => NULL]);
                    $this->emit('task_complete',  $tache_id, $tache->checklist_id, -1);

                }

            }else{
                $user_tache = $tache->replicate();
                $user_tache['user_id'] = auth()->id();
                $user_tache['tache_id'] = $tache_id;
                $user_tache['completed_at'] = now();
                $user_tache->save();
                $this->completed_tasks[] = $tache_id;
                $this->emit('task_complete',$tache_id,$tache->checklist_id);
            }

           
        }
    }

    public function add_to_my_day($tache_id)
    {
        $user_tache = Tache::where('user_id',auth()->id())
            ->where('id',$tache_id)
            ->first();

        if($user_tache){
            if(is_null($user_tache->added_to_my_day_at)){
                $user_tache->update(['added_to_my_day_at' => now()]);
                $this->emit('user_tasks_counter_change', 'my_day');
            } else {
                $user_tache->update(['added_to_my_day_at' => now()]);
                $this->emit('user_tasks_counter_change', 'my_day', -1);

            }
        } else {
            $tache = Tache::find($tache_id);
            $user_tache = $tache->replicate();
            $user_tache['user_id'] = auth()->id();
            $user_tache['$tache_id'] = $tache_id;
            $user_tache['added_to_my_day_at'] = now();
            $user_tache->save();
            $this->emit('user_tasks_counter_change', 'my_day');
        }

        $this->current_task = $user_tache;

    }
}
