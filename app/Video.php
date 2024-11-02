<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'user_id', 'titulo', 'slug', 'frame', 'main', 'active',
    ];
}
