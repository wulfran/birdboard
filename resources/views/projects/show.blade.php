@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $project->title }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
                {!! $project->description !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <a href="{{ route('projects.list') }}" class="btn btn-primary btn-md">Back</a>
        </div>
    </div>
@endsection