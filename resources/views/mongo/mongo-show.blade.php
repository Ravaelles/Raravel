@extends('layouts.app')

@section('html-title')
@if (!empty($query))
{!! $query !!}s
@else
Collection list
@endif
@endsection

@section('content')
<style>
    pre {
        line-height: 1em !important;
    }

    pre.sf-dump .sf-dump-compact {
        display: initial !important;
    }
    
    .sep {
        color:#999; 
        padding-left:10px; 
        padding-right:10px;
    }
    
    .btn-model {
        display: block; 
        max-width: 250px;
        margin-bottom: 10px;
        padding-top: 4px;
        padding-bottom: 4px;
        cursor: pointer !important;
    }

    .scaffold-actions {
        padding-left: 10px;
    }

    .btn-scaffold-action {
        min-width: auto;
        margin-left: 10px;
        padding: 10px 15px;
    }
    
    .btn-scaffold-action i {
        margin: 0;
    }
</style>

<div class="row" style="margin-bottom: 40px;">
    <div class="col-md-12">
        <div class="box box-default">

            {{-- ### Collections ############################################################## --}}
            @if ($collections !== null)
            <div class="" style="padding: 10px; padding-bottom: 10px;">
                Number of collections: <b>{!! count($collections) !!}</b>
            </div>

            @forelse ($collections as $collectionName)
            <a href="/hq/mongo/{!! $collectionName !!}" 
               class="btn btn-primary btn-app-blue btn-model">
                {!! $collectionName !!}
            </a>
            @empty
            <p>No collections in the db</p>
            @endforelse

            {{-- ### Objects ################################################################## --}}
            @else
            <div class="" style="padding: 10px; padding-bottom: 0px;">
                Number of objects: <b>{!! $objects->total() !!}</b>

                <span class="sep">|</span>

                <a href="/hq/mongo" style="color:#ccc">
                    Show all collections
                </a>

                <span class="sep">|</span>

                <a href="{!! route('mongo.add', [$class]) !!}" 
                   style="color:#ccc; margin-left: 5px;">
                    <i class="fa fa-plus-square-o" style="padding-right:2px;"></i> 
                    Add object
                </a>
            </div>

            @if (!is_array($objects))
            <div class="">
                {!! $objects->links() !!}
            </div>
            @endif

            <div class="flex-vcenter" style="margin-top: 10px;">
                <table class="" style="width: auto;">
                    <tbody>
                        @foreach ($objects as $object)
                        <tr style="border: none !important">

                            @include('mongo.partials.custom-columns')

                            <td>
                                <a href="{!! route('mongo.edit', [$class, $object->getId()]) !!}">
                                    {!! d([$object], false, false) !!}
                                </a>
                            </td>

                            <td class="scaffold-actions">
                                <a href="{!! route('mongo.remove', [$class, $object->getId()]) !!}"
                                   onclick="return confirmDelete('Are you sure?')"
                                   class="btn btn-scaffold-action btn-danger btn-app-red dont-fade">
                                    <i class="fa fa-trash-o" style=""></i> 
                                </a>
                                <a href="{!! route('mongo.edit', [$class, $object->getId()]) !!}"
                                   class="btn btn-scaffold-action btn-primary btn-app-blue">
                                    <i class="fa fa-pencil" style=""></i> 
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            @if (!is_array($objects))
            <div class="">
                {!! $objects->links() !!}
            </div>
            @endif

        </div>
    </div>
</div>
@endsection