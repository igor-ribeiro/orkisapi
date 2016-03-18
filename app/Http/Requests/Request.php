<?php

namespace OrkisApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

abstract class Request extends FormRequest
{
    /**
     * @var string
     */
    protected $rules = [];

    public function response(array $errors)
    {
        return response()->json(['errors' => $errors], 422);
    }

    /**
     * Parses the $rules array. Define rules for each request method like this:
     * 
     * $rules = [ 'post' => [ 'field' => 'rules' ] ]
     *
     * @return array 
     */
    public function rules()
    {
        $method = strtolower($this->method());

        $finalRules = $this->rules['all'];

        foreach (array_except($this->rules, 'all') as $ruleMethod => $validationRules) {
            if ($method !== $ruleMethod) {
                continue;
            }

            foreach ($validationRules as $field => $rules) {
                $rule = (isset($finalRules[$field]))
                    ? $finalRules[$field] . '|' . $rules
                    : $rules;

                $finalRules[$field] = $rule;
            }
        }

        return $finalRules;
    }
}
