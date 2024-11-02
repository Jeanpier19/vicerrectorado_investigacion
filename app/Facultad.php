<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facultad extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'nombre', 'slug', 'abreviatura', 'main', 'active',
    ];
    public function departamentos() {
    	return $this->hasMany(Departamento::class);
    }
    public function lineas(){
        return $this->belongsToMany(Linea::class, 'facultad_linea')
        	->withTimestamps();
    }
    public function sublineas(){
        return $this->belongsToMany(Sublinea::class, 'facultad_sublinea')
            ->withTimestamps();
    }
}
