@extends('layouts.app')

@section('page-header')
{!! $project->getName() !!}
@endsection

@section('content')
{!! Form::open([
'route' => ['project.post-add-function', $project->getName()], 
'id' => 'form-add-function'
]) !!}

<div class="form-group">
    {!! Form::label('name', 'Function name', ['class' => 'control-label']) !!}
    {!! Form::text('name', '', ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off', 'autofocus' => true]) !!}
</div>

<div class="form-group">
    {!! Form::label('class', 'Class', ['class' => 'control-label']) !!}
    <!--    {!! Form::text('class', '', ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off', 'autofocus' => true]) !!}-->
    {!! Form::select('class', $classes, null, ['class' => 'form-control']) !!}
</div>

<hr />

<div class="form-group">
    <button type="submit" class="btn btn-success">Create function</button>
</div>

{!! Form::close() !!}
@endsection