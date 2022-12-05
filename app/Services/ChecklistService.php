<?php

namespace App\Services;

use App\Models\Checklist;

class ChecklistService
{

    public function sync_checklist(Checklist $checklist, int $user_id) : Checklist
    {
        // $checklist = Checklist::find($checklist_id);

        $checklist =  Checklist::firstOrCreate(
            [
            'user_id' => $user_id,
            'checklist_id' => $checklist->id,
            ],
            [
            'checklist_group_id' => $checklist->checklist_group_id,
            'nom' => $checklist->nom,
            
            ]
        );

        $checklist->touch();
        
        return $checklist;
    }
}