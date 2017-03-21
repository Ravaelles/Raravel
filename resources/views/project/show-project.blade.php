@extends('layouts.app')

<?php
$favicon = $project->getPath() . "public/favicon.ico";
if (file_exists($favicon)) {
    $iconBase64 = 'data:image/ico;base64,' . base64_encode(file_get_contents($favicon));
}
?>

@section('page-header')
@if (!empty($iconBase64))
<img src="{!! $iconBase64 !!}" class="mr5" style="max-width:64px;max-height:64px" />
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