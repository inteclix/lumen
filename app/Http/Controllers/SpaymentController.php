<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;

use App\Spayment;
use App\Module;

class SpaymentController extends Controller
{
    function get($id, Request $request){
        try{
            $spayment = Spayment::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success get',
            'data' => $spayment
        ]);
    }

    function getAll(Request $request)
    {
        $spayments = Spayment::all();
        return new JsonResponse([
            'message' => 'Success get all',
            'data' => $spayments !== NULL ? $spayments : []
        ], Response::HTTP_OK);
    }

    function create(Request $request)
    {
        try {
            $this->validate($request, [
                'student_id' => 'required',
                'amount' => 'required',
            ]);
        } catch (ValidationException $e) {
            return new JsonResponse([
                'message' => 'Error fields required'
            ], Response::HTTP_BAD_REQUEST);
        }
        $spayment = new Spayment;
        $spayment->student_id = $request->student_id;
        $spayment->amount = $request->amount;
        try{
            $spayment->save();
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'error whene saving',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success create',
            'data' => $spayment
        ], Response::HTTP_CREATED);
    }

    function delete($id, Request $request){
        try{
            Spayment::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }
        Spayment::destroy($id);
        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }

    function update($id, Request $request){
        try{
            $spayment = Spayment::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            $this->validate($request, [
                'student_id' => 'required',
                'amount' => 'required',
            ]);
        } catch (ValidationException $e) {
            return new JsonResponse([
                'message' => 'Error fields required'
            ], Response::HTTP_BAD_REQUEST);
        }
        $spayment->student_id = $request->student_id;
        $spayment->amount = $request->amount;
        try{
            $spayment->save();
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'error whene saving',
            ], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse([
            'message' => 'updated',
            'data' => $spayment
        ]);
    }
}
