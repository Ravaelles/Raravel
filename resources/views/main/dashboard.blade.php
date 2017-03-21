@extends('layouts.app')

@section('page-header')
<i class="fa fa-dashboard mr5"></i> <span>Dashboard</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="container-fluid projects">
            @foreach ($projectsGrouped as $projectsGroup)
            <div class="row mt20 mb5">
                <h4 class="pb5 mb5" style="border-bottom: 1px solid #ccc;">
                    {!! $projectsGroup['name'] !!}
                </h4>
            </div>
            <div class="row">
                @foreach ($projectsGroup['projects'] as $project)
                <a class="btn btn-default" href="{!! route('project.show', $project->getName()) !!}">
                    <?php $favicon = $project->getFavicon(); ?>
                    @if ($favicon !== null)
                    <img src="{!! $favicon !!}" class="project-icon-small mr5" />
                    @endif
                    {!! $project->getName() !!}
                </a>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection