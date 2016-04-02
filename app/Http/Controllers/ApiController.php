<?php

namespace OrkisApp\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller {

    /**
     * Get a repository by model name
     *  
     * @param  string $model
     * @return BaseRepository       
     */
    public function repository($model)
    {
        return app('OrkisApp\\Repositories\\' . $model . 'Repository');
    }

    public function respondSuccess($data)
    {
        return $this->respond($data);
    }

    public function respondCreated($data)
    {
        return $this->respond($data, Response::HTTP_CREATED);
    }

    public function respondBadRequest($data)
    {
        return $this->respond([ 'errors' => $data, ], Response::HTTP_BAD_REQUEST);
    }

    protected function respond($data, $code = Response::HTTP_OK)
    {
        $data['status'] = $code;
        return response()->json($data, $code);
    }
}
