<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Linea extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'area_id', 'user_id', 'nombre', 'slug', 'main', 'active',
    ];
    public function area() {
    	return $this->belongsTo('App\Area');
    }
    public function sublineas() {
    	return $this->hasMany('App\Sublinea');
    }
    public function facultads(){
        return $this->belongsToMany('App\Facultad', 'facultad_linea')
            ->withTimestamps();
    }
}
