<?php

namespace OrkisApp\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return a response in JSON format
     * 
     * @param  mixed        $response   
     * @param  int|integer  $statusCode 
     * @return \Illuminate\Http\Response
     */
    protected function json($response = [], $statusCode = 200)
    {
        return response()->json($response, $statusCode);
    }

    protected function created($message = 'Resource created')
    {
        return response()->json([ 'message' => $message ], 201);
    }

    protected function badRequest($message = 'Missing information')
    {
        return response()->json([ 'message' => $message ], 400);
    }
}
