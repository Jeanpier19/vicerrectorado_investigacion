<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semestre extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'anio', 'periodo', 'slug', 'main', 'active',
    ];
    public function movilidads() {
    	return $this->hasMany('App\Movilidad');
    }
}
