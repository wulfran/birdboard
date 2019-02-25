@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="flex items-center mb-2">
                <a href="{{ route('projects.create') }}">Create</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <ul>
                @forelse($projects as $project)
                    <li>
                        <a href="{{ $project->getUrl() }}">
                            {{ $project->title }}
                        </a>
                    </li>
                @empty
                    <li>No projects yet</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection