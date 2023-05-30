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

    .table-edit-object .field-row {
        border: none !important;
    }

    .table-edit-object td {
        padding-top: 8px;
        padding-left: 10px;
    }

    .table-edit-object .field-row td:nth-child(1) {
        width: auto;
        padding-right: 15px;
        font-weight: bold;
    }

    .table-edit-object .field-row td:nth-child(2) {
        width: 100%;
    }

    .table-edit-object .field-row td:nth-last-child(-n+1) {
        padding-right: 8px;
    }

    .table-edit-object tr:nth-child(odd) {
        background-color: rgba(0,0,0,0.1);
    }

    .table-edit-object textarea {
        width: 100%;
        height: 1.85em;
        margin-right: 5px;
        padding-left: 5px;
    }

    .btn-app-red {
        opacity: 0.8;
        margin-top: -5px;
        padding: 2px 5px;
    }

    .btn-app-red:hover {
        opacity: 1;
    }
</style>

<?php
if ($isEditMode) {
    $routeName = 'mongo.update';
} else {
    $routeName = 'mongo.store';
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-default">

            <div class="" style="padding:10px; padding-top:0px;">
                <h3>{{ $isEditMode ? 'Edit' : 'Add' }} object</h3>
            </div>

            {!! Form::open([
            'url' => route($routeName, [$class, $id]),
            'id' => 'form-db-edit',
            ]) !!}

            <div class="mb20 ml15">
                <button type="submit" class="btn btn-success">
                    {!! $isEditMode ? 'Update' : 'Create' !!}
                </button>
                <a href="{!! route('mongo.show', [$class]) !!}" class="btn btn-warning ml10">Back</a>
            </div>

            <div class="flex-vcenter" style="margin-left: 15px; margin-top: 10px;">

                <table class="table-edit-object" style="width: 100%;">
                    <tbody>
                        <?php
//                        dd($object->getAttributes());
                        ?>
                        @if ($object !== null)
                        @foreach ($object->getAttributes() as $field => $value)

                        <?php
                        if (Illuminate\Support\Str::endsWith($field, "_at") || $value instanceof MongoDB\BSON\UTCDateTime) {
                            continue;
                        }

                        if ($field === '_id') {
                            $value = $value . "";
                        }

                        // =========================================================================

                        if (old($field)) {
                            $json = old($field);
                        } else if ($value === null) {
                            $json = null;
                        } else {
                            $json = json_encode($value, JSON_PRETTY_PRINT);
                        }
                        ?>

                        <tr class="field-row">
                            <td>
                                {!! $field !!}
                            </td>
                            <td>
                                <textarea name="{{ $field }}">{!! $json !!}</textarea>
                            </td>
                            <td>
                                @if ($field !== "_id")
                                <a href="#" class="btn btn-danger btn-app-red btn-remove-field"
                                   id="btn-remove-field" data-name="{!! $field !!}"
                                   style="min-width:auto">
                                    <i class="fa fa-trash-o" style="margin-right:0"></i>
                                </a>
                                @endif
                            </td>
                        </tr>

                        @endforeach
                        @endif

                        <tr class="special-row" style="background-color: rgba(0,0,0,0.0)">
                            <td></td>
                            <td>
                                <a href="#" class="btn btn-default" id="btn-add-field">
                                    <i class="fa fa-plus"></i> &nbsp; Add field
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt20 ml15">
                <button type="submit" class="btn btn-success">
                    {!! $isEditMode ? 'Update' : 'Create' !!}
                </button>
                <a href="{!! route('mongo.show', [$class]) !!}" class="btn btn-warning ml10">Back</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">

    function isValidJson(jsonString) {
        try {
            console.log(jsonString);
            var o = JSON.parse(jsonString);
            console.log(o);

            // Handle non-exception-throwing cases:
            // Neither JSON.parse(false) or JSON.parse(1234) throw errors, hence the type-checking,
            // but... JSON.parse(null) returns null, and typeof null === "object",
            // so we must check for that, too. Thankfully, null is falsey, so this suffices:
            if (o && typeof o === "object") {
                return true;
            }
        } catch (e) {
            // Do nothing
        }

        return false;
    }

    // =========================================================================

    $(document).ready(function () {

        $("textarea").focus();

        // === On FORM SUBMIT ================================================

        $("#form-db-edit").submit(function () {
            var isEveryFieldValid = true;
            var shownError = false;
            $("#form-db-edit textarea").each(function () {
                var text = $(this).val();
                if (text.length < 1) {
                    return;
                }

//                if (text.indexOf(' ') > -1 && text[0] != '"') {
                if (text[0] != '"') {
                    text = '"' + text + '"';
                    $(this).val(text);
                }

                if (!isValidJson('{"fakefield": ' + text + '}')) {
                    isEveryFieldValid = false;

                    if (!shownError) {
                        alert("Invalid JSON in field '" + $(this).attr('name') + "'");
                        shownError = true;
                    }
                }
            });
            return isEveryFieldValid;
        });

        // === NEW FIELD =====================================================

        $("#btn-add-field").click(function () {
            var name = prompt("What is the html 'name' of new field?", 'name');
            var html = "<tr class='field-row'><td>" + name + "</td><td><textarea \n\
    name='" + name + "' ></textarea></td></tr>";
            $(".table-edit-object tbody").append(html);

            setTimeout(function () {
                console.log($(".table-edit-object .field-row:nth-last-child(1)"));
                $(".table-edit-object .field-row:nth-last-child(1) textarea").get(0).focus();
                listenToFieldHeights();
            }, 50);
        });

        // === EVERY FIELD AS TALL AS NEEDED =================================

        function updateFieldHeight(object) {
            var text = $(object).val();
            var numberOfLineBreaks = (text.match(/\n/g) || []).length;
            var height = 1.85 + 1.5 * numberOfLineBreaks;
            $(object).css('height', height + 'em');
        }

        function listenToFieldHeights() {
            $(".table-edit-object textarea").each(function (index) {
                updateFieldHeight(this);
            });

            $(".table-edit-object textarea").keyup(function () {
                updateFieldHeight(this);
            });
        }

        listenToFieldHeights();

        // === Remove FIELD ==================================================

        $(".btn-remove-field").click(function () {
            var name = $(this).attr('data-name');
            $(this).closest('.field-row').remove();
//            $(this).closest('textarea').css('background-color', 'red');
//            $("textarea[name=" + name + "]")
////                    .css('opacity', '0.2')
////                    .val('------- TO REMOVE --------')
//                    .remove();

            $("#form-db-edit").append('<input type="hidden" name="_remove-fields[]" value="'
                    + name + '" />');
//            $(this).closest('textarea').remove();
        });

    });
</script>
@endpush
