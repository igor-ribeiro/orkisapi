<?php

namespace OrkisApp\Http\Controllers;

use Illuminate\Http\Request;

use OrkisApp\Http\Requests;

class OrchidsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('with_nurseries')) {
            $orchids = $this->repository('Orchid')->allWithNurseries();
        } else {
            $orchids = $this->repository('Orchid')->all();
        }

        return $this->respondSuccess([ 'data' => $orchids ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orchidData = $this->repository('Orchid')->generateData($request);
        $orchid = $this->repository('Orchid')->create($orchidData);

        return $this->respondCreated([ 'data' => $orchid ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $hash
     * @return \Illuminate\Http\Response
     */
    public function show($hash)
    {
        $orchid = $this->repository('Orchid')->findByHashWithNurseries($hash);

        return $this->respondSuccess([ 'data' => $orchid ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $hash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hash)
    {
        $orchid = $this->repository('Orchid')->updateByHash($hash, $request->all());

        return $this->respondSuccess([ 'data' => $orchid ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $hash
     * @return \Illuminate\Http\Response
     */
    public function destroy($hash)
    {
        //
    }

    public function hasNursery($orchidHash, $nurseryDocument)
    {
        $orchid = $this->repository('Orchid')->findByHash($orchidHash);

        $has = count($orchid->nurseries()->where('document', $nurseryDocument)->get()) > 0;

        return $this->respondSuccess([ 'data' => $has ]);
    }
}
