@extends('layouts.app')

@section('page-header')
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
                <a class="btn btn-default" href="{!! route('project.add-model', $project->getName()) !!}">
                    Add model
                </a>

                <br />

                <a class="btn btn-default" href="{!! route('project.add-helper', $project->getName()) !!}">
                    Add helper
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default panel-full-buttons">
            <div class="panel-heading">Functions</div>
            <div class="panel-body">
                <a class="btn btn-default" href="{!! route('project.add-eloquent', $project->getName()) !!}">
                    Add route
                </a>
            </div>
        </div>
    </div>

</div>
@endsection