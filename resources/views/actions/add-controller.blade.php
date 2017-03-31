@extends('layouts.app')

@section('page-header')
{!! $project->getName() !!}
@endsection

@section('content')
{!! Form::open([
'route' => ['project.post-add-controller', $project->getName()], 
'id' => 'form-add-controller'
]) !!}

<div class="form-group">

    {!! Form::label('class', 'Controller name', ['class' => 'control-label']) !!}
    {!! Form::text('class', 'Controller', ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off', 'autofocus' => true]) !!}

</div>

<hr />

<div class="form-group">
    <button type="submit" class="btn btn-success">Create controller</button>
</div>

{!! Form::close() !!}
@endsection