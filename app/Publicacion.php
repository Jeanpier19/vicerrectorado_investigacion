<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publicacion extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'user_id', 'tipo_publicacion_id', 'titulo', 'slug', 'descripcion', 'main', 'active',
    ];
    public function image() {
    	return $this->morphOne('App\Image', 'imageable');
    }
    public function file() {
    	return $this->morphOne('App\File', 'fileable');
    }
    public function tipo_publicacion() {
        return $this->belongsTo('App\TipoPublicacion');
    }
}
