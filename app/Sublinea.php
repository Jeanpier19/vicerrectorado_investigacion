<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sublinea extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'linea_id','user_id', 'numero', 'nombre', 'slug', 'main', 'active',
    ];
    public function linea() {
    	return $this->belongsTo(Linea::class);
    }
    public function circulos() {
        return $this->hasMany(Circulo::class);
    }
    public function facultads(){
        return $this->belongsToMany(Facultad::class, 'facultad_sublinea')
            ->withTimestamps();
    }
}
