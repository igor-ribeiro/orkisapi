<?php

namespace OrkisApp\Repositories;

class OrchidRepository extends BaseRepository
{
    protected $modelClass = 'Orchid';

    protected function findByHashBuilder($hash)
    {
        return $this->query()->where('hash', $hash);
    }

    public function findByHash($hash)
    {
        return $this->findByHashBuilder($hash)->firstOrFail();
    }

    public function updateByHash($hash, $data)
    {
        $orchid = $this->findByHash($hash);

        return $this->update($orchid, $data);
    }

    public function generateData($request)
    {
        $request->merge([
            'hash' => $this->generateHash($request->get('name')),
        ]);

        return $request->all();
    }

    public function generateHash($name)
    {
        return base_convert(md5($name . date('ymdhis')), 10, 36);       
    }
}
