<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;

use App\Tpayment;
use App\Module;

class TpaymentController extends Controller
{
    function get($id, Request $request){
        try{
            $tpayment = Tpayment::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success get',
            'data' => $tpayment
        ]);
    }

    function getAll(Request $request)
    {
        $tpayments = Tpayment::all();
        return new JsonResponse([
            'message' => 'Success get all',
            'data' => $tpayments !== NULL ? $tpayments : []
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
        $tpayment = new Tpayment;
        $tpayment->student_id = $request->student_id;
        $tpayment->amount = $request->amount;
        try{
            $tpayment->save();
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'error whene saving',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success create',
            'data' => $tpayment
        ], Response::HTTP_CREATED);
    }

    function delete($id, Request $request){
        try{
            Tpayment::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }
        Tpayment::destroy($id);
        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }

    function update($id, Request $request){
        try{
            $tpayment = Tpayment::findOrFail($id);
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
        $tpayment->student_id = $request->student_id;
        $tpayment->amount = $request->amount;
        try{
            $tpayment->save();
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'error whene saving',
            ], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse([
            'message' => 'updated',
            'data' => $tpayment
        ]);
    }
}
