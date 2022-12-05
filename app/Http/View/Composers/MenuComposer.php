<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Checklist;
use App\Models\ChecklistGroup;
use Carbon\Carbon;

class MenuComposer
{
    /**
     * Bind data to the view
     * 
     * @param  \Illuminate\View\View $view
     * @return void
     * 
     */
    public function compose(View $view)
    {
        $menu = \App\Models\ChecklistGroup::with([
            'checklists' => function($query){
                 $query->whereNull('user_id'); 
            }])
            ->get(); 

        $view->with('admin_menu', $menu);

        $groups = [];
        $last_action_at = auth()->user()->last_action_at;

        if (is_null($last_action_at)) {
            $last_action_at = now()->subYears(10);
        }
        
        foreach ($menu->toArray() as $group){

            if (count($group['checklists']) > 0) {
                $group['is_new'] = Carbon::create($group['created_at'])->greaterThan($last_action_at);
                $group['is_updated'] = !($group['is_new']) && Carbon::create($group['updated_at'])->greaterThan($last_action_at);


                foreach ($group['checklists'] as &$checklist){
                    $checklist['is_new'] = !($group['is_new']) && Carbon::create($checklist['created_at'])->greaterThan($last_action_at);
                    $checklist['is_updated'] = !($group['is_updated']) && !($checklist['is_new']) && Carbon::create($checklist['updated_at'])->greaterThan($last_action_at);
                    $checklist['taches'] = 1;
                    $checklist['taches_completes'] = 0;
                }
                $groups[] = $group;
            }
        }

        $view->with('user_menu', $groups);
    }
}