<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Story;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable=[
        'name',
        'slug',
        'description',
        'views',
        'featured'
    ];

    protected $guarded = ['id', '_token'];

    public function stories()
	{
		return $this->hasMany(Story::class);
	}
}
