<?php

namespace App\Services;

use App\Models\Checklist;
use App\Models\ChecklistGroup;
use App\Models\Tache;
use Illuminate\View\View;
use Carbon\Carbon;


class MenuService
{

    public function get_menu(): array
    {
        $menu = ChecklistGroup::with([
            'checklists' => function ($query) {
                $query->whereNull('user_id');
            },
            'checklists.taches' => function ($query) {
                $query->whereNull('taches.user_id');
            },
            'checklists.user_taches',
            'checklists.user_completed_taches',
        ])
            ->get();

        $groups = [];

        $last_action_at = auth()->user()->last_action_at;

        if (is_null($last_action_at)) {
            $last_action_at = now()->subYears(10);
        }

        $user_checklists = Checklist::where('user_id', auth()->id())->get();

        foreach ($menu->toArray() as $group) {

            if (count($group['checklists']) > 0) {

                // $group_updated_at = $user_checklists->where('checklist_group_id', $group['id'])->max('updated_at');
                $group_updated_at = $last_action_at;

                $group['is_new'] = $group_updated_at && Carbon::create($group['created_at'])->greaterThan($group_updated_at);
                $group['is_updated'] = !($group['is_new']) && $group_updated_at
                    && Carbon::create($group['updated_at'])->greaterThan($group_updated_at);


                foreach ($group['checklists'] as &$checklist) {

                    // $checklist_updated_at = $user_checklists->where('checklist_id', $checklist['id'])->max('updated_at');
                    $checklist_updated_at = $last_action_at;

                    $checklist['is_new'] = !($group['is_new'])
                        && $checklist_updated_at
                        && Carbon::create($checklist['created_at'])->greaterThan($checklist_updated_at);
                    $checklist['is_updated'] = !($group['is_new']) && !($group['is_updated'])
                        && !($checklist['is_new'])
                        && $checklist_updated_at
                        && Carbon::create($checklist['updated_at'])->greaterThan($checklist_updated_at);
                    $checklist['tasks_count'] = count($checklist['taches']);
                    $checklist['completed_tasks_count'] = count($checklist['user_taches']);
                    $checklist['completed_tasks_count'] = count($checklist['user_completed_taches']);

                }
                $groups[] = $group;
            }
        }

        $user_taches_menu = [];
        if (!auth()->user()->is_admin){
            $user_taches = Tache::where('user_id', auth()->id())->get();
            $user_taches_menu = [
                'my_day' => [
                    'name' => __('Ma journée'),
                    'icon' => 'fas fa-sun',
                    'tasks_count' => $user_taches->whereNotNull('added_to_my_day_at')->count()
                ],
                'important' => [
                    'name' => __('Priorisé'),
                    'icon' => 'fas fa-star',
                    'tasks_count' => 0
                ],
                'planned' => [
                    'name' => __('Plannifiées'),
                    'icon' => 'fas fa-calendar',
                    'tasks_count' => 0
                ],
            ];
        }

        return [
            'admin_menu' => $menu,
            'user_menu' =>$groups,
            'user_taches_menu' =>$user_taches_menu,
        ];
    }
}
