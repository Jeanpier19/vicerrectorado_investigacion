<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comunicado extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'tipo', 'titulo', 'slug', 'descripcion', 'fecha', 'lugar', 'dirigido', 'main', 'active',
    ];
    public function etiquetas() {
        return $this->belongsToMany('App\Etiqueta');
    }
    public function images() {
    	return $this->morphMany('App\Image', 'imageable');
    }
    public function files() {
    	return $this->morphMany('App\File', 'fileable');
    }
}
