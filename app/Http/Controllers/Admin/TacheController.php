<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTacheRequest;
use App\Models\Checklist;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.taches.edit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTacheRequest $request
     * @param Checklist $checklist
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTacheRequest $request, Checklist $checklist)
    {
        $position = $checklist->taches()->where('user_id', NULL)->max('position') + 1;

        $checklist->taches()->create($request->validated() + ['position' => $position]);

        session()->flash('message','la tâche a été ajoutée avec succés !!!');

        return redirect()->route('admin.checklist_groups.checklists.edit', [
            $checklist->checklist_group_id, $checklist
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

  
    public function edit(Checklist $checklist, $id)
    {

        $tache = Tache::where('id', '=', $id)->first();
        // return $tache;
        return view ('admin.taches.edit', compact('checklist','tache'));

    }

  
    public function update(Request $request, Checklist $checklist)
    {

        $request->validate([
            'nom' => 'required',
            'description' => 'required',
        ]);

        $id = $request->id;
        $nom = $request->nom;
        $description = $request->description;

        Tache::where('id','=', $id)->update([
            'nom' => $nom,
            'description' => $description
        ]);
   
        session()->flash('message','la tâche a été modifié avec succés !!!');

            return redirect()->route('admin.checklist_groups.checklists.edit', [
                $checklist->checklist_group_id, $checklist 
            ]);
        
    }

 
    public function destroy(Checklist $checklist, $id)
    {

        Tache::where('user_id', NULL)->where('id', '=', $id)->update([
            'position' => DB::raw('position - 1')
        ]);

        Tache::where('id','=', $id)->delete();

        session()->flash('message','la tâche a été supprimée avec succés !!!');

        return redirect()->route('admin.checklist_groups.checklists.edit', [
            $checklist->checklist_group_id, $checklist 
        ]);
    
       
    }

 

 
}
