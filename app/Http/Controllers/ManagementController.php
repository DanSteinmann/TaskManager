<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Task;

use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index()
    {
        $projects = Project::with('tasks')->get();
        return view('management.index', compact('projects'));
    }
    

}
