<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;

use App\Meeting;
use App\Module;

class MeetingController extends Controller
{
    function get($id, Request $request){
        try{
            $meeting = Meeting::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success get',
            'data' => $meeting
        ]);
    }

    function getAll(Request $request)
    {
        $meetings = Meeting::all();
        return new JsonResponse([
            'message' => 'Success get all',
            'data' => $meetings !== NULL ? $meetings : []
        ], Response::HTTP_OK);
    }

    function create(Request $request)
    {
        try {
            $this->validate($request, [
                'teacher_id' => 'required',
                'module_id' => 'required',
                'student_ids' => 'required',
            ]);
        } catch (ValidationException $e) {
            return new JsonResponse([
                'message' => 'Error fields required'
            ], Response::HTTP_BAD_REQUEST);
        }
        $meeting = new Meeting;
        $meeting->teacher_id = $request->teacher_id;
        $meeting->module_id = $request->module_id;
        try{
            $meeting->save();
            $meeting->students()->detach();
            $meeting->students()->attach($request->student_ids);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'error whene saving',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success create',
            'data' => $meeting
        ], Response::HTTP_CREATED);
    }

    function delete($id, Request $request){
        try{
            Meeting::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }
        Meeting::destroy($id);
        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }

    function update($id, Request $request){
        try{
            $meeting = Meeting::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            $this->validate($request, [
                'teacher_id' => 'required',
                'module_id' => 'required',
                'student_ids' => 'required',
            ]);
        } catch (ValidationException $e) {
            return new JsonResponse([
                'message' => 'Error fields required'
            ], Response::HTTP_BAD_REQUEST);
        }
        $meeting->teacher_id = $request->teacher_id;
        $meeting->module_id = $request->module_id;
        try{
            $meeting->save();
            $meeting->students()->detach();
            $meeting->students()->attach($request->student_ids);
        } catch (QueryException $e){
            return new JsonResponse([
                'message' => 'Sql exception'
            ], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse([
            'message' => 'updated',
            'data' => $meeting
        ]);
    }
}
