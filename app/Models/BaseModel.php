<?php

namespace OrkisApp\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BaseModel extends Model
{    
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->timestamp;
    }
}
