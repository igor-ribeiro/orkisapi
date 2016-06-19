<?php

namespace OrkisApp\Models;

use OrkisApp\Models\Traits\CreatedAt;
use Illuminate\Database\Eloquent\Model;

class Nursery extends Model
{
    use CreatedAt;

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

    public function orchids()
    {
        return $this->belongsToMany('OrkisApp\Models\Orchid', 'nurseries_orchids', 'nursery_id', 'orchid_id');
    }
}
