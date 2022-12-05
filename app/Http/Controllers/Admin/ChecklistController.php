<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChecklistRequest;
use App\Models\Checklist;
use App\Models\ChecklistGroup;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.checklist.edit');
    }

  
    public function create(ChecklistGroup $checklistGroup) : View
    {
        return view('admin.checklist.form', compact('checklistGroup'));
    }

   
    public function store(StoreChecklistRequest $request, ChecklistGroup $checklistGroup): RedirectResponse
    {
        $checklistGroup->checklists()->create($request->validated());

        session()->flash('message','Checklist ajouté avec succés');
        return redirect()->route('welcome');
    }

  
    public function edit(ChecklistGroup $checklistGroup, Checklist $checklist): View
    {
        return view('admin.checklist.edit', compact('checklistGroup', 'checklist'));
    }

  
    public function update(StoreChecklistRequest $request, ChecklistGroup $checklistGroup, Checklist $checklist): RedirectResponse
    {
        $checklist->update($request->validated());

        session()->flash('message','Checklist modifié avec succés');
        return redirect()->route('welcome');
    }

   
    public function destroy(ChecklistGroup $checklistGroup, Checklist $checklist): RedirectResponse
    {
        $checklist->delete();

        session()->flash('message','Checklist supprimé avec succés');
        return redirect()->route('welcome');
    }

    
}
