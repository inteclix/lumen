<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;

use App\Student;
use App\Module;

class StudentController extends Controller
{
    function get($id, Request $request){
        try{
            $student = Student::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success get',
            'data' => [
                "student" => $student,
                "spayments" => $student->spayments()
            ]
        ]);
    }

    function getAll(Request $request)
    {
        $students = Student::all();
        return new JsonResponse([
            'message' => 'Success get all',
            'data' => $students !== NULL ? $students : []
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
        $student = new Student;
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->fathername = $request->fathername;
        $student->tel = $request->tel;
        $student->gender = $request->gender;
        $student->description = $request->description;
        $student->birth_date = $request->birth_date;
        try{
            $student->save();
            $student->modules()->detach();
            $student->modules()->attach($request->module_ids);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'error whene saving',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success create',
            'data' => $student
        ], Response::HTTP_CREATED);
    }

    function delete($id, Request $request){
        try{
            Student::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }
        Student::destroy($id);
        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }

    function update($id, Request $request){
        try{
            $student = Student::findOrFail($id);
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
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->fathername = $request->fathername;
        $student->tel = $request->tel;
        $student->gender = $request->gender;
        $student->description = $request->description;
        $student->birth_date = $request->birth_date;
        try{
            $student->save();
            $student->modules()->detach();
            $student->modules()->attach($request->module_ids);
        } catch (QueryException $e){
            return new JsonResponse([
                'message' => 'Sql exception'
            ], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse([
            'message' => 'updated',
            'data' => $student
        ]);
    }
}
