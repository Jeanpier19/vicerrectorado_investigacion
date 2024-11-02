<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicacionCapitulo extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'investigador_id', 'titulo', 'libro', 'editor', 'ciudad', 'pais', 'anio', 'main', 'active',
    ];
    public function investigador() {
        return $this->belongsTo('App\Investigador');
    }
}
