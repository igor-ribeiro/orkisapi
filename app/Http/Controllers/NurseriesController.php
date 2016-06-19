<?php

namespace OrkisApp\Http\Controllers;

use Storage;
use OrkisApp\Http\Requests\NurseryRequest;

class NurseriesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nurseries = $this->repository('Nursery')->all();

        return $this->respondSuccess([ 'data' => $nurseries ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrkisApp\Http\Requests\NurseryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NurseryRequest $request)
    {
        $user = $this->repository('User')->findByUsername($request->get('username'));

        $nursery = $this->repository('Nursery')->create($request->except('username'));

        if (! $user->nurseries()->save($nursery)) {
            return $this->respondBadRequest([ 'message' => 'Could not store the entity' ]);
        }

        return $this->respondCreated([ 'data' => $nursery ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $document
     * @return \Illuminate\Http\Response
     */
    public function show($document)
    {
        $nursery = $this->repository('Nursery')->findByDocumentWithUser($document);

        return $this->respondSuccess([ 'data' => $nursery ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrkisApp\Http\Requests\NurseryRequest  $request
     * @param  int  $document
     * @return \Illuminate\Http\Response
     */
    public function update(NurseryRequest $request, $document)
    {
        $nursery = $this->repository('Nursery')->updateByDocument($document, $request->all());

        return $this->respondSuccess([ 'data' => $nursery ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($document)
    {
        $nursery = $this->repository('Nursery')->deleteByDocument($document);

        return $this->respondSuccess([ 'data' => $nursery ]);
    }

    public function addOrchid($document, $orchidHash)
    {
        $nursery = $this->repository('Nursery')->findByDocument($document);
        $orchid = $this->repository('Orchid')->findByHash($orchidHash);

        $nursery->orchids()->save($orchid);

        $filename = 'codes/' . $document . '/' . $orchidHash . '.png';

        Storage::disk('public')->put(
            $filename,
            file_get_contents('https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . $document . ':' . $orchidHash)
        );

        return $this->respondSuccess([ 'data' => [
            'filename' => $filename,
            'document' => $document,
            'hash' => $orchidHash,
        ] ]);
    }

    public function getAvailableToOrchid($username, $orchidHash)
    {
        $user = $this->repository('User')->findByUsername($username);
        $nurseries = [];

        foreach ($user->nurseries as $nursery) {
            if (! $this->repository('Nursery')->hasOrchid($nursery->document, $orchidHash)) {
                $nurseries[] = $nursery;
            }
        }

        return $this->respondSuccess([ 'data' => $nurseries ]);
    }
}
