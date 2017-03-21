@extends('layouts.app')

@section('page-header')
{!! $project->getName() !!}
@endsection

@section('content')
{!! Form::open([
'route' => ['project.post-add-class', $project->getName()], 
'id' => 'form-add-class'
]) !!}

<div class="form-group">

    {!! Form::label('class', 'Class name', ['class' => 'control-label']) !!}
    {!! Form::text('class', '', ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off', 'autofocus' => true]) !!}

</div>

<hr />

<div class="form-group">
    <button type="submit" class="btn btn-success">Create class</button>
</div>

{!! Form::close() !!}
@endsection