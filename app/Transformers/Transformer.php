<?php

namespace OrkisApp\Transformers;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Transformer
{
    public function transform($item)
    {
        if (is_null($item)) {
            return null;
        }

        if ($item instanceof Model) {
            return $this->transformModel($item);
        }

        return $this->transformCollection($item);
    }

    protected function transformModel($model)
    {
        return $this->transformer($model);
    }

    protected function transformCollection($collection)
    {
        return $collection->map(function($model)
        {
            return $this->transformModel($model);
        });

    }
}
