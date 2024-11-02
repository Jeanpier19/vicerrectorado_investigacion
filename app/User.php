<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

use LaravelAndVueJS\Traits\LaravelPermissionToVueJS;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes, HasApiTokens, LaravelPermissionToVueJS;

    protected $fillable = [
        'username', 'password', 'persona_id',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function image() {
        return $this->morphOne('App\Image', 'imageable');
    }
    public function persona() {
        return $this->belongsTo('App\Persona');
    }
    public function investigador() {
        return $this->hasOne('App\Investigador');
    }
}
