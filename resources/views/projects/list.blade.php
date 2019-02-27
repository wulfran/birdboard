@extends('layouts.app')


@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-center">
            <h2 class="text-grey text-small font-normal">
                My Projects
            </h2>
            <a class="button" href="{{ route('projects.create') }}">New Project</a>
        </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                <div class="bg-white p-5 rounded-lg shadow" style="height: 200px;">
                    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-light pl-4 mb-3">
                        <a class="text-black no-underline" href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
                    </h3>

                    <div class="text-grey">{{ str_limit($project->description, 100) }}</div>
                </div>
            </div>
        @empty
            <div>
                No projects yet.
            </div>
        @endforelse
    </main>
@endsection