@extends('layouts.app')

<?php
$favicon = $project->getFavicon();
?>

@section('page-header')
@if ($favicon !== null)
<img src="{!! $favicon !!}" class="project-icon-big mr5" />
@endif
{!! $project->getName() !!}
@endsection

@section('content')
<div class="row mt20 mb5">

    <div class="col-md-4">
        <div class="panel panel-default panel-full-buttons">
            <div class="panel-heading">Static</div>
            <div class="panel-body">
                <a class="btn btn-default" href="{!! route('project.add-eloquent', $project->getName()) !!}">
                    Add MongoDB Eloquent model
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default panel-full-buttons">
            <div class="panel-heading">Class</div>
            <div class="panel-body">
                <a class="btn btn-default" href="{!! route('project.add-model', $project->getName()) !!}"
                   @include('partials.ui.tooltip', [
                   'message' => 'Will be placed in app/'
                   ])>
                   Add model
            </a>

                <br />

            <a class="btn btn-default" href="{!! route('project.add-helper', $project->getName()) !!}"
               @include('partials.ui.tooltip', [
               'message' => 'Will be placed in app/Helpers'
               ])>
               Add helper
            </a>

            <br />

        <a class="btn btn-default" href="{!! route('project.add-class', $project->getName()) !!}"
           @include('partials.ui.tooltip', [
           'message' => 'Will be placed in app/Classes'
           ])>
           Add class
            </a>
        </div>
    </div>
</div>

    <div class="col-md-4">
        <div class="panel panel-default panel-full-buttons">
            <div class="panel-heading">Functions</div>
            <div class="panel-body">
                <a class="btn btn-default" href="{!! route('project.add-function', $project->getName()) !!}">
                    Add function
            </a>
        </div>
    </div>
</div>

</div>
@endsection