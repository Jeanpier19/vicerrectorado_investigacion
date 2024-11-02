<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'facultad_id', 'user_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function facultad() {
    	return $this->belongsTo('App\Facultad');
    }
    public function investigadors() {
    	return $this->belongsTo('App\Investigador');
    }
}
