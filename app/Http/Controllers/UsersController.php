<?php

namespace OrkisApp\Http\Controllers;

use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use OrkisApp\Http\Requests\UserRequest;

class UsersController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository('User')->all();

        return response()->json([ 'data' => $users ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \OrkisApp\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validation = Validator::make($request->toArray(), [
            'email' => 'unique:users',
        ]);

        if ($validation->fails()) {
            return response()->json([ 'errors' => $validation->errors(), 422]);
        }

        $userData = $this->repository('User')->generateData($request);

        $user = $this->repository('User')->create($userData);

        return $this->json([ 'data' => $user ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = $this->repository('User')->findByUsernameWithNursery($username);
        return response()->json([ 'data' => $user ]);

        return response()->json([ 'data' => $user ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $username)
    {
        Validator::make($request->toArray(), [
            'email' => 'unique:users,email,NULL,id,username,' . $username,
        ]);

        $data = empty($request->get('password'))
            ? $request->except([ 'password' ])
            : $request->all();

        $user = $this->repository('User')->updateByUsername($username, $data);

        return response()->json([ 'data' => $user ], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $username
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        $user = $this->repository('User')->deleteByUsername($username);

        return response()->json([ 'data' => $user ]);
    }
    
    /**
     * Get all the nurseries from user 
     *
     * @param  string $username
     * @return \Illuminate\Http\Response
     */
     public function nurseries($username)
     {
        $nurseries = $this->repository('Nursery')->allFromUserByUsername($username);

        return response()->json([ 'data' => $nurseries ]);
     }

     /**
      * Return an user and a  token based on the credentials given
      *
      * @param Request $request
      * @return \Illuminate\Http\Response
      */
     public function login(Request $request)
     {
        $credentials = [
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ];

        $user = $this->repository('User')->findByUsername($request->get('username'));

        if (Auth::attempt($credentials)) {
            $user = $this->repository('User')->updateByUsername($credentials['username'], [
                'token' => md5($credentials['username'] . Carbon::now()),
                'token_expires_at' => Carbon::now()->addDay(),
            ]);
            
            return $this->respondSuccess([
                'user' => $user,
                'token' => $user->token,
            ]);
        }

        return $this->respondBadRequest([ 'message' => 'Invalid credentials' ]);
     }
}
