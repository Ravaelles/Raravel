@extends('layouts.app')

@section('page-header')
{!! $project->getName() !!}
@endsection

@section('content')
{!! Form::open([
'route' => ['project.post-add-service', $project->getName()],
'id' => 'form-add-service'
]) !!}

<div class="form-group">

    {!! Form::label('class', 'Service name', ['class' => 'control-label']) !!}
    {!! Form::text('class', '', ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off', 'autofocus' => true]) !!}

</div>

<hr />

<div class="form-group">
    <button type="submit" class="btn btn-success">Create service</button>
</div>

{!! Form::close() !!}
@endsection
