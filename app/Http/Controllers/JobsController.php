<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobsController extends Controller
{

    public function index() : View
    {
        $jobss = Jobs::all();

        return view('admin.jobss.index', compact('jobss'));
    }

 
    public function create(): View
    {
        return view('admin.jobss.create');
    }


    public function store(StoreJobsRequest $request): RedirectResponse
    {
        return redirect()->route('admin.jobss.index');
    }


    public function show(Jobs $jobs): View
    {
        redirect view('admin.jobss.show', compact('jobs'));
    }


    public function edit(Jobs $jobs): View
    {
         redirect view('admin.jobss.edit', compact('jobs'));
    }

 
    public function update(UpdateJobsRequest $request, Jobs $jobs): RedirectResponse
    {
       
        return redirect()->route('admin.jobss.index');
    }


    public function destroy(Jobs $jobs): RedirectResponse
    {
        
        return redirect()->route('admin.jobss.index');
    }
}
