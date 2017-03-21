@extends('layouts.app')

@section('page-header')
{!! $project->getName() !!}
@endsection

@section('content')
<div class="row mt20 mb5">
    <a class="btn btn-default" href="{!! route('project.add-model', $project->getName()) !!}">
        Add model
    </a>
</div>
@endsection