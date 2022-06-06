<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'isAdmin',
        'tel',
        'cin',
        'ville',
        'dateNaissance',
        'sexe',
        'etatFumeur',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function demandes()
    {
        return $this->belongstoMany(Trajet::class, 'user_trajet')->withPivot('acceptance');
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }

}
