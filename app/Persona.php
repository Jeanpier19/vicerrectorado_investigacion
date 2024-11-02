<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'dni', 'nombres', 'apellidos', 'genero', 'fecha_nacimiento', 'email', 'telefono', 'direccion', 'sitio_web',
    ];
    public function user() {
        return $this->hasOne(User::class);
    }
    public function get_concat_nombres_apellidos() {
    	return $this->nombres . ' ' . $this->apellidos;
    }
    public function get_concat_apellidos_nombres() {
    	return $this->apellidos . ' ' . $this->nombres;
    }
}
