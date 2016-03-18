<?php

namespace OrkisApp\Repositories;

use OrkisApp\Models\User;

class NurseryRepository extends BaseRepository
{
    protected $modelClass = 'Nursery';

    public function findByDocumentBuilder($document)
    {
        return $this->query()->where('document', $document);
    }

    public function findByDocument($document)
    {
        return $this->findByDocumentBuilder($document)->firstOrFail();
    }

    public function findByDocumentWithUser($document)
    {
        return $this->findByDocumentBuilder($document)->with('user')->firstOrFail();
    }

    public function allFromUserByUsernameBuilder($username)
    {
        return $this->query()->whereHas('user', function($query) use ($username)
        {
            $query->where('username', $username);
        });
    }

    public function allFromUserByUsername($username)
    {
        $query = $this->allFromUserByUsernameBuilder($username)->orderBy('created_at', 'desc');

        return $this->execute($query);
    }

    public function updateByDocument($document, $data)
    {
        $nursery = $this->findByDocument($document);

        return $this->update($nursery, $data);
    }

    public function deleteByDocument($document)
    {
        $nursery = $this->findByDocument($document);

        return $this->delete($nursery);
    }
}
