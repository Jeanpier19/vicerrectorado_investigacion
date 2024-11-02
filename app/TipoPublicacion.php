<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPublicacion extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'user_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function publicacions() {
    	return $this->hasMany('App\Publicacion');
    }
}
