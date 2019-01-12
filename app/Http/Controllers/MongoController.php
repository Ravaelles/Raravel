<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\ClassHelper;

class MongoController extends Controller
{
    public function show($class = "", $id = "")
    {
        if ($class == "") {
            $client = DB::getMongoClient();
            $db = DB::getMongoDB();
            $collections = [];
            $collections = $this->getModels();

            $objects = [];
            $collections = collect($collections)->sort();
        } else {
            $collections = null;
            $className = "\\App\\$class";

            $objects = [];

            if ($id !== "") {
                $objects = $className::where('_id', $id)->paginate(50);
                if (count($objects) <= 0) {
                    echo "<style>b { "
                        . "font-size: 110%; color:#0ae; padding-left:5px; padding-right:5px; "
                        . "}</style>";
                    die("<b>$className</b> with id <b>'$id'</b> does not exist");
                }
            } // === Paginate ===========================================================
            else {
                $objects = $className::paginate(50);
            }
        }

        $query = $class;

        return view('mongo.mongo-show')->with(compact('objects', 'query', 'collections', 'class'));
    }

    public function edit(Request $request, $class, $id = null)
    {
        $className = "\\App\\$class";
        $isEditMode = $id != null || ends_with($request->path(), "/edit");

        // =========================================================================
        // EDIT MODE
        if ($isEditMode) {
            $object = $className::find($id);

            if ($isEditMode && $object === null && $id === null) {
                $object = $className::find("");
            }

            if ($object === null) {
                echo "<style>b { "
                    . "font-size: 110%; color:#0ae; padding-left:5px; padding-right:5px; "
                    . "}</style>";
                die("<b>$className</b> with id <b>'$id'</b> does not exist");
            }
        } // ADD MODE
        else {
            $object = $className::orderBy('_id', 'DESC')->take(1)->first();
            if ($object !== null) {
                foreach ($object->getAttributes() as $key => $value) {
                    if (!is_array($value)) {
                        $object->$key = null;
                    }
                }
            }

            unset($object['_id']);
        }

        // === Handle POST =========================================================

        if ($request->isMethod('POST')) {
            $inputs = $request->except('_token', '_method');

            if (!empty($inputs['_remove-fields'])) {
                $removeFields = $inputs['_remove-fields'];
                unset($inputs['_remove-fields']);
            } else {
                $removeFields = [];
            }

            $invalidJsonKey = null;
            $parsedInputs = [];
            foreach ($inputs as $key => $value) {
                if (empty($value)) {
                    $parsedInputs[$key] = null;
                    continue;
                }

                // Melee weapon
                if (!\App\Helpers\StringHelper::isValidJSON($value)) {
                    $invalidJsonKey = $key;
                    break;
                } else {
                    $parsedInputs[$key] = json_decode($inputs[$key]);
                }
            }

            // === Validated, now UPDATE ===========================================

            if ($invalidJsonKey === null) {

                // === Handle ADD NEW ==============================================

                if (!$isEditMode) {
                    $object = new $className;
                }

                // =================================================================

                if (isset($object['_id'])) {
                    $parsedInputs['_id'] = $object['_id'] . "";
                }

                foreach ($parsedInputs as $key => $value) {
                    $object->$key = $value;
                }

                foreach ($removeFields as $field) {
                    unset($object[$field]);
                }

                $object->save();

                if ($removeFields) {
                    $className::where('_id', $object['_id'])->unset($removeFields);
                }

                $actionTaken = $isEditMode ? 'Updated' : 'Created';
                \Flash::success("$actionTaken $class '" . $this->getObjectDescription($object) . "'!");
                return redirect()->route('mongo.show', [$class]);
            } // === Error, get back =================================================
            else {
                \Flash::error("Invalid JSON for the field '$invalidJsonKey'!");
                return redirect()->route('mongo.edit', [$class, $id])
                    ->withInput();
            }
        }

        // =========================================================================

        $query = $class;

        return view('mongo.mongo-edit')->with(compact(
            'object', 'query', 'class', 'id', 'isEditMode'
        ));
    }

    public function remove($class, $id = "")
    {
        $className = "\\App\\$class";

        $object = $className::findOrFail($id);
        $result = $className::findOrFail($id)->delete();

        \Flash::error("$class '" . $this->getObjectDescription($object) . "' has been removed.");

        return redirect()->route('mongo.show', [$class]);
    }

    // =========================================================================

    private function getObjectDescription($result)
    {
        if (!empty($result->fullBaseName)) {
            return $result->fullBaseName;
        } else if (!empty($result->name)) {
            return $result->name;
        } else {
            return $result->getId();
        }
    }

    private function getModels()
    {
        $models = [];

        foreach (glob(app_path("*.php")) as $file) {
            $modelName = str_remove($file, app_path() . "/");
            $modelName = str_remove($modelName, ".php");
            $models[] = $modelName;
        }

        return $models;
    }
}
