<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'user_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function lineas() {
    	return $this->hasMany(Linea::class);
    }
    public function sublineas() {
        return $this->hasManyThrough('App\Sublinea', 'App\Linea');
    }
}