<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;

use App\Teacher;
use App\Module;

class TeacherController extends Controller
{
    function get($id, Request $request){
        try{
            $teacher = Teacher::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success get',
            'data' => [
                "teacher" => $teacher,
                "tpayments" => $teacher->tpayments()
            ]
        ]);
    }

    function getAll(Request $request)
    {
        $teachers = Teacher::all();
        return new JsonResponse([
            'message' => 'Success get all',
            'data' => $teachers !== NULL ? $teachers : []
        ], Response::HTTP_OK);
    }

    function create(Request $request)
    {
        try {
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'module_ids' => 'required',
            ]);
        } catch (ValidationException $e) {
            return new JsonResponse([
                'message' => 'Error fields required'
            ], Response::HTTP_BAD_REQUEST);
        }
        $teacher = new Teacher;
        $teacher->firstname = $request->firstname;
        $teacher->lastname = $request->lastname;
        $teacher->gender = $request->gender;
        $teacher->description = $request->description;
        $teacher->tel = $request->tel;
        try{
            $teacher->save();
            $teacher->modules()->detach();
            $teacher->modules()->attach($request->module_ids);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'error whene saving',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success create',
            'data' => $teacher
        ], Response::HTTP_CREATED);
    }

    function delete($id, Request $request){
        try{
            Teacher::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }
        Teacher::destroy($id);
        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }

    function update($id, Request $request){
        try{
            $teacher = Teacher::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'module_ids' => 'required',
            ]);
        } catch (ValidationException $e) {
            return new JsonResponse([
                'message' => 'Error fields required'
            ], Response::HTTP_BAD_REQUEST);
        }
        $teacher->firstname = $request->firstname;
        $teacher->lastname = $request->lastname;
        $teacher->tel = $request->tel;
        $teacher->gender = $request->gender;
        $teacher->description = $request->description;
        try{
            $teacher->save();
            $teacher->modules()->detach();
            $teacher->modules()->attach($request->module_ids);
        } catch (QueryException $e){
            return new JsonResponse([
                'message' => 'Sql exception'
            ], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse([
            'message' => 'updated',
            'data' => $teacher
        ]);
    }
}
