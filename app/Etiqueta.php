<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etiqueta extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'user_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function comunicados() {
    	return $this->belongsToMany('App\Comunicado');
    }
}
