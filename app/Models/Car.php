<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque',
        'user_id',
        'matricule',
        'nbPlace',
        'etatVoiture'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }
}
