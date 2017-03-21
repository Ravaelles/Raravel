@extends('layouts.app')

@section('page-header')
{!! $project->getName() !!}
@endsection

@section('content')
{!! Form::open([
'route' => ['project.post-add-helper', $project->getName()], 
'id' => 'form-add-model'
]) !!}

<div class="form-group">

    {!! Form::label('class', 'Helper name', ['class' => 'control-label']) !!}
    {!! Form::text('class', 'Helper', ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off', 'autofocus' => true]) !!}

</div>

<div class="form-group">
    <button type="submit" class="btn btn-success">Create helper</button>
</div>

{!! Form::close() !!}
@endsection