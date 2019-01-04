@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">

        {!! Form::open([
        'url' => route(''),
        ]) !!}

        <div class="card">
            <div class="card-title">
            </div>
		
            <div class="card-block">
                
            </div>

            <div class="card-buttons">
                <button type="submit" href="{!! route('test') !!}" class="btn v-btn special-icon v-peter-river">
                    <i class="fa fa-hand-o-right"></i>
                    Next
                </button>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
</div>
@endsection