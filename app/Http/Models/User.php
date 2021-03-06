<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Http\Models\Category;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function category() {
        return $this->belongsToMany(Category::class, 'user_category')->withTimestamps();
    }
}
