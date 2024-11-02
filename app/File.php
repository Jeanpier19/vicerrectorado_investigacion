<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'name', 'path', 'fileable_type', 'fileable_id',
    ];
    public function fileable() {
    	return $this->morphTo();
    }
}
