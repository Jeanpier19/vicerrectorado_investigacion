<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Circulo extends Model
{
    use SoftDeletes;
    
	protected $fillable = [
        'sublinea_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function sublinea() {
    	return $this->belongsTo(Sublinea::class);
    }
    public function miembros(){
        return $this->belongsToMany(User::class, 'circulo_miembro')
            ->withPivot('id', 'rol', 'main', 'active');
    }
}
