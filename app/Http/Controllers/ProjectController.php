<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            ]
        );

        Project::create($request->except('_token', '_method'));
        return redirect()->route('management.index')->with('message', 'Project created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('project.create', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate(
            [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            ]
        );
        
        $project->update($request->all());
        return redirect()->route('management.index')->with('message', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->tasks()->where('state', '=', false)->count() > 0) {
            return redirect()->route('management.index')->with('error', 'Cannot delete a project with active tasks.');
        }

        $project->delete();
        return redirect()->route('management.index')->with('message', 'Project deleted !');
    }
}
