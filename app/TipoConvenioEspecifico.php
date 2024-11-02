<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoConvenioEspecifico extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'grupo_convenio_especifico_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function convenios() {
    	return $this->hasMany('App\Convenio');
    }
    public function grupo_convenio_especifico() {
    	return $this->belongsTo('App\GrupoConvenioEspecifico');
    }
}
