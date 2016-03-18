<?php

namespace OrkisApp\Repositories;

class UserRepository extends BaseRepository
{
    protected $modelClass = 'User';

    protected function allWithNurseryBuilder()
    { 
        return $this->query()->with('nursery');
    }

    public function allWithNursery()
    {
        $query = $this->allWithNurseryBuilder()->orderBy('created_at', 'desc');

        return $this->execute($query);
    }

    protected function findWithNurseryBuilder($id)
    {
        return $this->query()->findOrFail($id)->with('nursery');
    }

    public function findWithNursery($id)
    {
        $query = $this->findWithNurseryBuilder();
        
        return $this->execute($query);
    }

    protected function findByUsernameBuilder($username)
    {
        return $this->query()->where('username', $username);
    }

    public function findByUsername($username)
    {
        return $this->findByUsernameBuilder($username)->firstOrFail();
    }

    public function findByUsernameWithNursery($username)
    {
        return $this->findByUsernameBuilder($username)->with('nursery')->firstOrFail();
    }

    public function updateByUsername($username, $data)
    {
        $user = $this->findByUsername($username);

        return $this->update($user, $data);
    }

    public function deleteByUsername($username)
    {
        $user = $this->findByUsername($username);

        return $this->delete($user);
    }

    public function generateData($request)
    {
        $request->merge([
             'username' => $this->generateUsername($request->get('first_name'), $request->get('last_name')),
             'password' => $this->generatePassword($request->get('password')),
        ]);

        return $request->all();
    }

    public function generateUsername($firstName, $lastName)
    {
        return str_slug($firstName . ' ' . $lastName);
    }

    public function generatePassword($password)
    {
        return bcrypt($password);
    }
}
