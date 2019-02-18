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

    public function postSave()
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        auth()->user()->projects()->create($data);

        return redirect()->back();
    }

    public function getShow(Project $project)
    {
        if(auth()->user()->isNot($project->user)){
            abort(403);
        }
//        if(auth()->id() != $project->user_id) {
//            abort(403);
//        }
        return view('projects.show', compact(['project']));
    }
}
