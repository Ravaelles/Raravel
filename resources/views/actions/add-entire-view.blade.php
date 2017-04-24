@extends('layouts.app')

@section('page-header')
Add route, function and view to {!! $project->getName() !!}
@endsection

@section('content')
{!! Form::open([
'route' => ['project.post-add-entire-view', $project->getName()], 
'id' => 'form-add-entire-view'
]) !!}

<div class="form-group">
    {!! Form::label('name', 'Function name', ['class' => 'control-label']) !!}
    {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'function_name', 'required' => true, 'autocomplete' => 'off', 'autofocus' => true]) !!}
</div>

<div class="form-group">
    {!! Form::label('view-name', 'View name', ['class' => 'control-label']) !!}
    {!! Form::text('view-name', '', ['class' => 'form-control', 'id' => 'view_name', 'required' => true, 'autocomplete' => 'off', 'autofocus' => true]) !!}
</div>

<!--<div class="form-group">
    <div class="checkbox checkbox-primary">
        <input type="checkbox" id="checkbox1" name="static">
        <label for="checkbox1">
            Static
        </label>
    </div>
</div>-->

<div class="form-group">
    {!! Form::label('class', 'Class', ['class' => 'control-label']) !!}
    <!--    {!! Form::text('class', '', ['class' => 'form-control', 'required' => true, 'autocomplete' => 'off', 'autofocus' => true]) !!}-->
    {!! Form::select('class', $classes, session('last-class'), ['class' => 'form-control']) !!}
</div>

<hr />

<div class="form-group">
    <button type="submit" class="btn btn-success">Add route, function and view</button>
</div>
{!! Form::close() !!}
@endsection

{{-- ############################################################################# --}}

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#function_name").keyup(function(e) {
            $("#view_name").val($("#function_name").val() + ".blade.php");
        });
    });
</script>
@endpush