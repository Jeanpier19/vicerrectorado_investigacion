<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupoConvenioEspecifico extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function tipo_convenio_especificos() {
    	return $this->hasMany(TipoConvenioEspecifico::class);
    }
}
