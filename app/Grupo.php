<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'nombre', 'integrantes', 'producciones', 'estado', 'activo', 'borrado','linea_id'
    ];

    public function linea() {
        return $this->belongsTo('App\Linea');
    }
}
