<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoInstitucion extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function institucions() {
    	return $this->hasMany('App\Institucion');
    }
}
