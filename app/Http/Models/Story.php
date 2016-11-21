<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Category;
use App\Http\Models\Tag;

class Story extends Model
{
	protected $table = 'stories';

    protected $fillable=[
        'chapter',
        'number',
        'title',
        'content',
        'author',
        'publisher',
        'image',
        'slug',
        'categories_id',
        'tags_id'
    ];

    /*public function Author(){
		return $this->belongsTo('Author');
	}*/
	public function categories()
	{
		return $this->belongsTo(Category::class);
	}

	public function tags()
	{
		return $this->belongsTo(Tag::class);
	}
}
