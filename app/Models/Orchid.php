<?php

namespace OrkisApp\Models;

use OrkisApp\Models\Traits\CreatedAt;
use Illuminate\Database\Eloquent\Model;

class Orchid extends Model
{
    use CreatedAt;

    protected $guarded = [
        'id',
    ];
    
    protected $hidden = [
        'id', 'updated_at',
    ];
}
