<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function getIndex()
    {
        $projects = auth()->user()->projects;

        return view('projects.list', compact([
            'projects'
        ]));
    }

    public function getAdd()
    {
        return view('projects.create');
    }

    public function postSave()
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3'
        ]);

        $project = auth()->user()->projects()->create($data);

        return redirect(route('projects.show', ['project' => $project]));
    }

    public function getShow(Project $project)
    {
        if(auth()->user()->isNot($project->user)){
            abort(403);
        }

        return view('projects.show', compact(['project']));
    }

    public function postUpdate(Project $project)
    {
        $this->authorize('update', $project);

        $project->update(request(['notes']));

        return redirect(route('projects.show' , ['project' => $project]));
    }
}
