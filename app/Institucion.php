<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institucion extends Model
{
	use SoftDeletes;

	protected $fillable = [
        'tipo_institucion_id', 'user_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function tipo_institucion() {
        return $this->belongsTo('App\TipoInstitucion');
    }
    public function convenios() {
        return $this->hasMany('App\Convenio');
    }
}
