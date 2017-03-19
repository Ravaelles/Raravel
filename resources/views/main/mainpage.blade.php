@extends('layouts.app')

@section('content')
<div class="projects">
    @foreach ($projectsGrouped as $projectsGroup)
    <div class="row mt20 mb5">
        <button type="button" class="btn btn-default">
            {!! $projectsGroup['name'] !!}
        </button>
    </div>
    <div class="row">
        @foreach ($projectsGroup['projects'] as $project)
        <a class="btn btn-primary" href="{!! route('project.show', ['path' => substr($project['path'], 1)]) !!}">
            {!! $project['name'] !!}
        </a>
        @endforeach
    </div>
    @endforeach
</div>

<style>
    .projects .btn {
        margin-right: 10px;
        margin-top: 5px;
        margin-bottom: 5px;
    }
</style>
@endsection