<?php

namespace OrkisApp\Models;

class Nursery extends BaseModel
{
    /**
     * @var array
     */
    protected $appends = [
        'createdAt',
    ];

    /**
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'id', 'user_id', 'updated_at', 'created_at',
    ];

    /**
     * User relationship
     * 
     * @return OrkisApp\Models\User
     */
    public function user()
    {
        return $this->belongsTo('OrkisApp\Models\User');
    }
}
