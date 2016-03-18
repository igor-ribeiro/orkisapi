<?php

namespace OrkisApp\Transformers;

class UserTransformer extends Transformer
{
    protected function transformer($model)
    {
        $nuseryTransformer = new NurseryTransformer();

        return [
            'name'      => $model->fullName(),
            'email'     => $model->email,
            'firstName' => $model->first_name,
            'lastName'  => $model->last_name,
            'username'  => $model->username,
            'createdAt' => $model->createdAt(),
            'nursery'   => $nuseryTransformer->transform($model->nursery),
        ];
    }
}
