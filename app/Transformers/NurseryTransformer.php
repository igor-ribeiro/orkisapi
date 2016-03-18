<?php

namespace OrkisApp\Transformers;

class NurseryTransformer extends  Transformer
{
    /**
     * @param  Collection $item
     * @return Collection
     */
    protected function transformer($nursery)
    {
        return [
            'name'      => $nursery->name,
            'document'  => $nursery->document,
            'createdAt' => $nursery->createdAt(), 
        ];
    }
}
