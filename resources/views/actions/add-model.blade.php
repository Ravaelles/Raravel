@extends('layouts.app')

@section('page-header')
{!! $project->getName() !!}
@endsection

@section('content')
{!! Form::open([
'route' => ['project.post-add-model', $project->getName()], 
'id' => 'form-add-model'
]) !!}

<div class="form-group">

    {!! Form::label('class', 'Class name', ['class' => 'control-label']) !!}
    {!! Form::text('class', '', ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off']) !!}

</div>

<div class="form-group">
    <button type="submit" class="btn btn-success">Create model</button>
</div>

{!! Form::close() !!}
@endsection