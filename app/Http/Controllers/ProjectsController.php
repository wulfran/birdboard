<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function getIndex(){
        $projects = Project::all();

        return view('projects.list', compact([
            'projects'
        ]));
    }

    public function postSave()
    {
        $data = request()->validate(['title' => 'required', 'description' => 'required']);

        Project::create($data);

        return redirect()->back();
    }

    public function getShow(Project $project)
    {
        return view('projects.show', compact([
            'project'
        ]));
    }

    public function test(Project $project){
        dd($project);
    }
}
