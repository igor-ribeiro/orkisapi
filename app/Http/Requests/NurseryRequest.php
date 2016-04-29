<?php

namespace OrkisApp\Http\Requests;

class NurseryRequest extends Request
{
    /**
     * @var array
     */
    protected $rules = [
        'all' => [
            'username' => 'exists:users',
            'name'     => 'min:3|max:64',
            'document' => 'digits:14',
        ],

        'post' => [
            'username' => 'required',
            'name'     => 'required',
            'document' => 'required|unique:nurseries',
        ]
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
