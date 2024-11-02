<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoFinanciacion extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function proyectos() {
    	return $this->hasMany(Proyecto::class);
    }
}
