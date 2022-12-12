<?php

namespace App\Http\Livewire;

use App\Models\Tache;
use Livewire\Component;

class ChecklistShow extends Component
{
    public $checklist;
    public $list_type;
    public $list_name;
    public $list_tasks;
    public $user_tasks;
    
    public $opened_tasks = [];
    public $completed_tasks = [];

    public ?Tache $current_task;

    public $due_date_opened = FALSE;
    public $due_date;

    public $note_opened = FALSE;
    public $note;


    public function mount()
    {
            $this->current_task = NULL;
    }

    public function render()
    {
        if (is_null($this->list_type)){
            $this->list_name = $this->checklist->nom;
            $this->list_tasks = $this->checklist->taches->where('user_id', NULL);
            $this->user_tasks = $this->checklist->user_taches()->get();
            $this->completed_tasks = $this->checklist->user_taches
                    ->whereNotNull('completed_at')
                    ->pluck('tache_id')
                    ->toArray();  
        } else {
            switch ($this->list_type){
                case 'my_day': 
                    $this->list_name = __('Ma journée');
                    $this->user_tasks = Tache::where('user_id', auth()->id())
                        ->whereNotNull('added_to_my_day_at')
                        ->get();
                        break;
                case 'important' :
                    $this->list_name = __('Important');
                    $this->user_tasks = Tache::where('user_id', auth()->id())
                        ->where('is_important', 1)
                        ->get();
                        break;
                case 'planned':
                    $this->list_name = __('Plannifiées');
                    $this->user_tasks = Tache::where('user_id', auth()->id())
                        ->whereNotNull('due_date')
                        ->orderBy('due_date')
                        ->get();
                        break;
            }

            $this->list_tasks = Tache::whereIn('id',$this->user_tasks->pluck('tache_id'))->get();
            $this->completed_tasks = $this->user_tasks
                    ->whereNotNull('completed_at')
                    ->pluck('tache_id')
                    ->toArray();
        }
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
                $user_tache->update(['added_to_my_day_at' => Null]);
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

    public function mark_as_important($tache_id)
    {
        $user_tache = Tache::where('user_id', auth()->id())
        ->where(function($query) use ($tache_id){
            $query->where('id', $tache_id)
            ->orWhere('tache_id', $tache_id);
        })
        ->first();

        if($user_tache){
            if($user_tache->is_important == 0){
                $user_tache->update(['is_important' => 1]);
                $this->emit('user_tasks_counter_change', 'important');
            } else {
                $user_tache->update(['is_important' => 0]);
                $this->emit('user_tasks_counter_change', 'important', -1);

            }
        } else {
            $task = Tache::find($tache_id);
            $user_tache = $task->replicate();
            $user_tache['user_id'] = auth()->id();
            $user_tache['tache_id'] = $tache_id;
            $user_tache['is_important'] = 1;
            $user_tache->save();
            $this->emit('user_tasks_counter_change', 'important');

        }
        $this->current_task = $user_tache;

    }

    public function toggle_due_date(){
        $this->due_date_opened = !$this->due_date_opened;
    }

    public function set_due_date($tache_id, $due_date = NULL){
        $user_tache = Tache::where('user_id', auth()->id())
        ->where(function ($query) use ($tache_id){
            $query->where('id', $tache_id)
            ->orWhere('tache_id', $tache_id);
        })
        ->first();
        if ($user_tache){
            if (is_null($due_date)){
                $user_tache->update(['due_date' => NULL]);
                $this->emit('user_tasks_counter_change', 'planned', -1);
            } else {
                $user_tache->update(['due_date' => $due_date]);
                $this->emit('user_tasks_counter_change', 'planned');
            }
        } else {
            $task = Tache::find($tache_id);
            $user_tache = $task->replicate();
            $user_tache['user_id'] = auth()->id();
            $user_tache['tache_id'] = $tache_id;
            $user_tache['due_date'] = $due_date;
            $user_tache->save();
            $this->emit('user_tasks_counter_change','planned');

        }
        $this->current_task = $user_tache ;
    }

    public function updateDueDate($value)
    {
        $this->set_due_date($this->current_task->id, $value);
    }

    public function toggle_note(){
        $this->note_opened = !$this->note_opened;
        $this->note = $this->current_task->note;
    }

    public function save_note()
    {
        $this->current_task->update(['note' => $this->note]);
        $this->note_opened = FALSE;
    }


}
