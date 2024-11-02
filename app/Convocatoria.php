<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Convocatoria extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'tipo_convocatoria_id', 'titulo', 'slug', 'descripcion', 'desde', 'hasta', 'agenda', 'main', 'active',
    ];
    public function tipo_convocatoria() {
        return $this->belongsTo('App\TipoConvocatoria');
    }
    public function images() {
    	return $this->morphMany('App\Image', 'imageable');
    }
    public function files() {
    	return $this->morphMany('App\File', 'fileable');
    }
}
