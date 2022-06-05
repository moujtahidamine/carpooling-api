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

        'user_id'
    ];

    public function users()
    {
        return $this->belongstoMany(User::class);
    }

    public function conducteur()
    {
        return $this->belongsTo(User::class);
    }
}
