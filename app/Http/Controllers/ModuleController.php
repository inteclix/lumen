<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;

use App\Module;
use PhpParser\Node\Expr\AssignOp\Mod;

class ModuleController extends Controller
{
    function get($id, Request $request){
        try{
            $module = Module::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'message' => 'Success get',
            'data' => $module
        ]);
    }

    function getAll(Request $request)
    {
        $modules = Module::all();
        return new JsonResponse([
            'message' => 'Success get all',
            'data' => $modules !== NULL ? $modules : []
        ], Response::HTTP_OK);
    }

    function create(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
            ]);
        } catch (ValidationException $e) {
            return new JsonResponse([
                'message' => 'Error fields required'
            ], Response::HTTP_BAD_REQUEST);
        }
        $module = new Module;
        $module->name = $request->name;
        $module->time = $request->time;
        $module->day = $request->day;
        try{
            $module->save();
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Error when saving',
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'message' => 'Success created',
            'data' => $module
        ], Response::HTTP_CREATED);
    }

    function delete($id, Request $request){
        try{
            Module::findOrFail($id);
            Module::destroy($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Error when deleting',
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }

    function update($id, Request $request){
        try{
            $module = Module::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            $this->validate($request, [
                'name' => 'required',
            ]);
        } catch (ValidationException $e) {
            return new JsonResponse([
                'message' => 'Error fields required'
            ], Response::HTTP_BAD_REQUEST);
        }
        $module->name = $request->name;
        $module->time = $request->time;
        $module->day = $request->day;
        try{
            $module->save();
        } catch (QueryException $e){
            return new JsonResponse([
                'message' => 'Sql exception'
            ], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse([
            'message' => 'updated',
            'data' => $module
        ]);
    }
}
