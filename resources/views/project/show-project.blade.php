@extends('layouts.app')

<?php
$favicon = $project->getFavicon();
?>

@section('html-title')
{!! $project->getName() !!} - Raravel
@endsection

@section('page-header')
@if ($favicon !== null)
<img src="{!! $favicon !!}" class="project-icon-big mr5" />
@endif
{!! $project->getName() !!}
@endsection

@section('content')
<div class="row mt20 mb5">

    <div class="col-md-3">
        <div class="panel panel-default panel-full-buttons">
            <div class="panel-heading">Static</div>
            <div class="panel-body">
                <a class="btn btn-default" href="{!! route('project.add-eloquent', $project->getName()) !!}"
                   @include('partials.ui.tooltip', [
                   'message' => 'Add hardcoded model that will be used in place of the standard model'
                   ])>
                   Add MongoDB Eloquent
            </a>
        </div>
    </div>
</div>

    <div class="col-md-3">
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

            <a class="btn btn-default" href="{!! route('project.add-class', $project->getName()) !!}"
       @include('partials.ui.tooltip', [
       'message' => 'Will be placed in app/Classes'
       ])>
       Add class
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

    <div class="col-md-3">
        <div class="panel panel-default panel-full-buttons">
            <div class="panel-heading">Complex</div>
            <div class="panel-body">
                <a class="btn btn-default" href="{!! route('project.add-function', $project->getName()) !!}">
                    Add function + route
                </a>

                <br />

                <a class="btn btn-default" href="{!! route('project.add-entire-view', $project->getName()) !!}">
                    Add view + route
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        @include('project.partials.install')
    </div>

</div>
@endsection