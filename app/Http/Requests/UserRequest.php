<?php

namespace OrkisApp\Http\Requests;

class UserRequest extends Request
{
    /**
     * @var array
     */
    protected $rules = [
        'all' => [
            'first_name' => 'min:3|max:64|alpha',
            'last_name'  => 'min:3|max:64|alpha',
            'email'      => 'email|max:128',
        ],

        'post' => [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'password'   => 'required|min:4',
        ],
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
