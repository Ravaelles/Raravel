@extends('layouts.app')

@section('html-title')
{!! $project->getName() !!} - Raravel
@endsection

@section('page-header')
@if ($project->getFavicon() !== null)
<img src="{!! $project->getFavicon() !!}" class="project-icon-big mr5" />
@endif
{!! $project->getName() !!}
@endsection

@section('content')
<div class="row mt20 mb5">

    <!--    <div class="col-md-3">
            <div class="panel panel-default panel-full-buttons">
            <div class="panel-heading">Static</div>
            <div class="panel-body">

            </div>
    </div>
    </div>-->

    <div class="col-md-4">
        <div class="panel panel-default panel-full-buttons">
            <div class="panel-heading">Class</div>
            <div class="panel-body">

                <a class="btn btn-default" href="{!! route('project.add-class', $project->getName()) !!}"
                   @include('partials.ui.tooltip', [
                   'message' => 'Will be placed in app/Classes'
                   ])>
                   Add class
            </a>

                <br />

            <a class="btn btn-default" href="{!! route('project.add-controller', $project->getName()) !!}"
               @include('partials.ui.tooltip', [
               'message' => 'Will be placed in app/Controller'
               ])>
               Add controller
            </a>

            <br />

        <a class="btn btn-default" href="{!! route('project.add-helper', $project->getName()) !!}"
           @include('partials.ui.tooltip', [
           'message' => 'Will be placed in app/Helpers'
           ])>
           Add helper
            </a>

        <br />

    <a class="btn btn-default" href="{!! route('project.add-model', $project->getName()) !!}"
       @tooltip('Will be placed in app/')
       >
       Add model
            </a>

    <br />

<a class="btn btn-default" href="{!! route('project.add-trait', $project->getName()) !!}"
   @include('partials.ui.tooltip', [
   'message' => 'Will be placed in app/Traits'
   ])>
   Add trait
            </a>
        </div>
    </div>
</div>

    <div class="col-md-4">
        <div class="panel panel-default panel-full-buttons">
            <div class="panel-heading">Routes</div>
            <div class="panel-body">
                <a class="btn btn-default" href="{!! route('project.add-function', $project->getName()) !!}"
                   @tooltip('Add function snippet to proper class, add route to web.php')
                   >
                   Add route + function
            </a>

            <br />
            <a class="btn btn-default" href="{!! route('project.add-post-function', $project->getName()) !!}"
               @tooltip('Add POST function snippet to proper class, add route to web.php')
               >
               Add route + POST function
            </a>

        <br />

    <a class="btn btn-default" href="{!! route('project.add-entire-view', $project->getName()) !!}"
       @tooltip('Create view, add function snippet to proper class, add route to web.php')
       >
       Add route + function + view
            </a>
    </div>
        </div>

        <div class="panel panel-default panel-full-buttons">
            <div class="panel-heading">Function</div>
            <div class="panel-body">
                <a class="btn btn-default" href="{!! route('project.add-function', $project->getName()) !!}"
                   @tooltip('Add function snippet to proper class, add route to web.php')
                   >
                   Add function + route
            </a>

            <br />
            </div>
        </div>
</div>

    <div class="col-md-4">
        @include('project.partials.install')
    </div>

</div>
@endsection