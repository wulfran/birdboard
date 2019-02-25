@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Birdboard - create a project</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('projects.save') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input class="form-control" type="text" name="title" id="title">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control" name="description" id="description" cols="135" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-1">
                        <input type="submit" class="btn btn-primary btn-md" value="Submit">
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-default btn-md" href="{{ route('projects.list') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection