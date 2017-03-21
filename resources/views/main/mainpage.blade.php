@extends('layouts.app')

@section('page-header')
Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="container projects">
            @foreach ($projectsGrouped as $projectsGroup)
            <div class="row mt20 mb5">
                <h4 class="pb5 mb5" style="border-bottom: 1px solid #ccc;">
                    {!! $projectsGroup['name'] !!}
                </h4>
            </div>
            <div class="row">
                @foreach ($projectsGroup['projects'] as $project)
                <a class="btn btn-default" href="{!! route('project.show', $project->getName()) !!}">
                    {!! $project->getName() !!}
                </a>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection