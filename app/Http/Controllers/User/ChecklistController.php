<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Services\ChecklistService;

class ChecklistController extends Controller
{
   public function show(Checklist $checklist) 
   {
      // Synchronisation du checklist depuis admin
      (new ChecklistService())->sync_checklist($checklist, auth()->id());

      return view ( 'users.checklist.show', compact('checklist'));
   }
}
