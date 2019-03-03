@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-center">
            <p class="text-grey text-sm font-normal">
                <a class="text-grey text-sm font-normal no-underline" href="{{ route('projects.list') }}">My Projects</a> / {{ $project->title }}
            </p>
            <a class="button" href="{{ route('projects.create') }}">New Project</a>
        </div>
    </header>

    <main>
        <div class="flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-8">
                <div class="mb-6">
                    <h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>
                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form action="{{ route('projects.tasks.patch', ['project' => $project, 'task' => $task]) }}" method="POST">
                                @method('PATCH')
                                {{ csrf_field() }}
                                <div class="flex">
                                    <input type="text" name="body" value="{{ $task->body }}" class="w-full {{ $task->completed? 'text-grey' : '' }}">
                                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="card mb-3">
                        <form action="{{ route('projects.tasks.add', ['project' => $project]) }}" method="POST">
                            {{ csrf_field() }}
                            <input name="body" type="text" placeholder="No tasks yet, add one" class="w-full">
                        </form>
                    </div>
                </div>

                <div class="">
                    <h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>
                    <form action="{{ $project->getUrl() }}" method="POST">
                        @method('PATCH')
                        {{ csrf_field() }}
                        <textarea name="notes" class="card w-full mb-4" style="min-height: 200px;" placeholder="Projects yellow pad">{{ $project->notes }}</textarea>

                        <button type="submit" class="button">Save</button>
                    </form>
                </div>
            </div>
            <div class="lg:w-1/4 px-3 mt-8">
                @include('projects.components.card')
            </div>
        </div>
    </main>
@endsection