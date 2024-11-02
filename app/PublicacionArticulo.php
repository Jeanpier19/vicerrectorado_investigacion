<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicacionArticulo extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'investigador_id', 'titulo', 'revista_indizada', 'anio', 'volumen', 'paginas', 'numero', 'ciudad', 'pais', 'main', 'active',
    ];
    public function investigador() {
        return $this->belongsTo('App\Investigador');
    }
}
