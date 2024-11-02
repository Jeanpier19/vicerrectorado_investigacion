<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeria extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'titulo', 'slug', 'descripcion', 'main', 'active',
    ];
    public function images() {
    	return $this->morphMany('App\Image', 'imageable');
    }
}
