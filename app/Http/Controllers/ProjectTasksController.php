<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function postSave(Project $project)
    {
        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect()->route('projects.list');
    }
}
