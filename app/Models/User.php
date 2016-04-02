<?php

namespace OrkisApp\Models;

use OrkisApp\Models\Traits\CreatedAt;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use CreatedAt;
    /**
     * @var array
     */
    protected $appends = [
        'firstName', 'lastName', 'name', 'createdAt'
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
        'password', 'remember_token', 'id', 'updated_at', 'first_name', 'last_name', 'created_at',
    ];

    /**
     * Add firstName attribute to replace first_name on
     * JSON representation of the model
     *
     * @return string
     */
    public function getFirstNameAttribute()
    {
        return $this->attributes['first_name'];
    }

    /**
     * Add lastName attribute to replace last_name on
     * JSON representation of the model
     *
     * @return string
     */
    public function getLastNameAttribute()
    {
        return $this->attributes['last_name'];
    }
    
    /**
     * Add name attribute
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->fullName();
    }
    
    /**
     * Nursery relationship
     * 
     * @return OrkisApp\Models\Nursery
     */
    public function nurseries()
    {
        return $this->hasMany('OrkisApp\Models\Nursery');
    }


    public function getId()
    {
        return $this->attributes['id'];    
    }

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
