<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function postSave(Project $project)
    {
        if(auth()->user()->isNot($project->user)){
            abort(403);
        }

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->getUrl());
    }

    public function postUpdate(Project $project, Task $task)
    {
        if(auth()->user()->isNot($project->user)){
            abort(403);
        }

        request()->validate(['body' => 'required']);

        $task->update([
            'body' => request('body'),
            'completed' => request()->has('completed')
        ]);

        return redirect(route('projects.show', ['project' => $project]));
    }
}
