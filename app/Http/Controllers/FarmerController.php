<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;

use App\Farmer;

class FarmerController extends Controller
{
    function get($id, Request $request){
        try{
            $farmer = Farmer::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success get',
            'data' => $farmer
        ]);
    }

    function getAll(Request $request)
    {
        $farmers = Farmer::all();
        return new JsonResponse([
            'message' => 'Success get all',
            'data' => $farmers !== NULL ? $farmers : []
        ], Response::HTTP_OK);
    }

    function create(Request $request)
    {

        $farmer = Farmer::create($request);
        try{
            $farmer->save();
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'error whene saving',
            ], Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse([
            'message' => 'Success create',
            'data' => $farmer
        ], Response::HTTP_CREATED);
    }

    function delete($id, Request $request){
        try{
            Farmer::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }
        Farmer::destroy($id);
        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }

    function update($id, Request $request){
        try{
            $farmer = Farmer::findOrFail($id);
        } catch (Exception $e){
            return new JsonResponse([
                'message' => 'Id d\'ont exist',
            ], Response::HTTP_BAD_REQUEST);
        }

        $farmer->update($request);
        try{
            $farmer->save();
        } catch (QueryException $e){
            return new JsonResponse([
                'message' => 'Sql exception'
            ], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse([
            'message' => 'updated',
            'data' => $farmer
        ]);
    }
}
