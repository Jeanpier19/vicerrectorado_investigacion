<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movilidad extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'facultad_id', 'institucion_id', 'semestre_id', 'tipo', 'nombres', 'apellidos', 'pais', 'modalidad', 'main', 'active',
    ];
    public function facultad() {
    	return $this->belongsTo('App\Facultad');
    }
    public function institucion() {
    	return $this->belongsTo('App\Institucion');
    }
    public function semestre() {
    	return $this->belongsTo('App\Semestre');
    }
    public function files() {
        return $this->morphMany('App\File', 'fileable');
    }
}
