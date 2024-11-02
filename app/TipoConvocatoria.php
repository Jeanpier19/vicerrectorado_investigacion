<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoConvocatoria extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function convocatorias() {
    	return $this->hasMany('App\Convocatoria');
    }
}
