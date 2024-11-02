<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Convenio extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'facultad_id', 'institucion_id', 'tipo_convenio_especifico_id', 'tipo', 'resolucion', 'palabras_clave', 'objetivo', 'obligaciones', 'telefono', 'ambito', 'pais', 'inicio', 'finalizacion', 'estado', 'main', 'active',
    ];
    public function semestre() {
        return $this->belongsTo('App\Semestre');
    }
    public function facultad() {
    	return $this->belongsTo('App\Facultad');
    }
    public function institucion() {
    	return $this->belongsTo('App\Institucion');
    }
    public function tipo_convenio_especifico() {
    	return $this->belongsTo('App\TipoConvenioEspecifico');
    }
    public function files() {
        return $this->morphMany('App\File', 'fileable');
    }
}
