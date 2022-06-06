<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'villeDepart',
        'villeArrive',
        'prix',
        'dateDepart',
        'nbPlace',

        'user_id',
        'car_id',
    ];

    public function users()
    {
        return $this->belongstoMany(User::class, 'user_trajet')->withPivot('acceptance');
    }

    public function conducteur()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
