<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Story;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name','slug', 'description', 'sort', 'parent_id'];

    protected $guarded = ['id', '_token'];

    public function stories()
	{
		return $this->hasMany(Story::class);
	}

	public function user()
    {
        return $this->belongsToMany('App\Http\Model\User', 'user_category')->withTimestamps();
    }
}
