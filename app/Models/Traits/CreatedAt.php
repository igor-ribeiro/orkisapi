<?php

namespace OrkisApp\Models\Traits;

use Carbon\Carbon;

trait CreatedAt
{    
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->timestamp;
    }
}
