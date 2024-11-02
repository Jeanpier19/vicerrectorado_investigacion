<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'circulo_id', 'facultad_id', 'investigador_id', 'sublinea_id', 'tipo_financiacion_id', 'tipo', 'clase', 'titulo', 'resumen', 'abstract', 'objetivos', 'palabras_clave', 'responsable', 'corresponsables', 'colaboradores', 'anio', 'fecha_inicio', 'fecha_fin', 'presupuesto', 'estado', 'entregable', 'resultados_esperados', 'link', 'main', 'active',
    ];
    
    public function file() {
    	return $this->morphOne('App\File', 'fileable');
    }
    public function circulo() {
        return $this->belongsTo('App\Circulo');
    }
    public function facultad() {
        return $this->belongsTo('App\Facultad');
    }
    public function investigador() {
        return $this->belongsTo('App\Investigador');
    }
    public function sublinea() {
        return $this->belongsTo('App\Sublinea');
    }
    public function tipo_financiacion() {
        return $this->belongsTo('App\TipoFinanciacion');
    }
    public function instituciones(){
        return $this->belongsToMany('App\Institucion', 'institucion_proyecto');
    }
}
