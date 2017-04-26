@extends('layouts.app')

@section('page-header')
Add function (with route)
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
    <button type="submit" class="btn btn-success">Create function</button>
</div>
{!! Form::close() !!}
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        
        // Give FOCUS TO FUNCTION NAME when class is changed
        $("#class").change(function () {
            $("#name").focus();            
        });
        
    });

    // =========================================================================

    function kebabCase(string) {
        var result = string;

        // Convert camelCase capitals to kebab-case.
        result = result.replace(/([a-z][A-Z])/g, function (match) {
            return match.substr(0, 1) + '-' + match.substr(1, 1).toLowerCase();
        });

        // Convert non-camelCase capitals to lowercase.
        result = result.toLowerCase();

        // Convert non-alphanumeric characters to hyphens
        result = result.replace(/[^-a-z0-9]+/g, '-');

        // Remove hyphens from both ends
        result = result.replace(/^-+/, '').replace(/-$/, '');

        return result;
    }
</script>
@endpush