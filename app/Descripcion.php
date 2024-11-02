<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Descripcion extends Model
{
	use SoftDeletes;

	protected $fillable = [
        'descripcion', 'nosotros', 'mision', 'vision', 'organigrama_path', 'direccion', 'email_1', 'email_2', 'email_3', 'telefono_1', 'telefono_2', 'telefono_3', 'anexo_1', 'anexo_2', 'anexo_3', 'celular_1', 'celular_2', 'celular_3',
    ];
    public function image() {
    	return $this->morphOne('App\Image', 'fileable');
    }
    public function file() {
    	return $this->morphOne('App\File', 'fileable');
    }
}
