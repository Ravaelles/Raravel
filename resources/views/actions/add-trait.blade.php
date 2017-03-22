@extends('layouts.app')

@section('page-header')
{!! $project->getName() !!}
@endsection

@section('content')
{!! Form::open([
'route' => ['project.post-add-trait', $project->getName()], 
'id' => 'form-add-trait'
]) !!}

<div class="form-group">

    {!! Form::label('class', 'Trait name', ['class' => 'control-label']) !!}
    {!! Form::text('class', '', ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off', 'autofocus' => true]) !!}

</div>

<hr />

<div class="form-group">
    <button type="submit" class="btn btn-success">Create trait</button>
</div>

{!! Form::close() !!}
@endsection