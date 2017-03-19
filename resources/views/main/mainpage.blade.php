@extends('layouts.app')

@section('content')
@foreach ($projectsGrouped as $projectsGroup)
<div class="row mt20 mb5">
    <button type="button" class="btn btn-default">
        {!! $projectsGroup['name'] !!}
    </button>
</div>
<div class="row">
    @foreach ($projectsGroup['projects'] as $project)
    <button type="button" class="btn btn-primary">
        {!! $project['name'] !!}
    </button>
    @endforeach
</div>
@endforeach
@endsection