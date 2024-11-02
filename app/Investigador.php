<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investigador extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'departamento_id', 'user_id', 'fecha_inicio', 'hoja_vida', 'categoria', 'grado', 'cti', 'orcid'
    ];
    public function departamento() {
    	return $this->belongsTo('App\Departamento');
    }
    public function user() {
    	return $this->belongsTo('App\User');
    }
    public function proyectos() {
        return $this->hasMany('App\Proyecto');
    }
    public function publicacion_articulos() {
        return $this->hasMany('App\PublicacionArticulo');
    }
    public function publicacion_capitulos() {
        return $this->hasMany('App\PublicacionCapitulo');
    }
    public function publicacion_libros() {
        return $this->hasMany('App\PublicacionLibro');
    }
}
