<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'link', 'main', 'active',
    ];
    public function image() {
    	return $this->morphOne('App\Image', 'imageable');
    }
}
