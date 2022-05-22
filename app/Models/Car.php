<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Car extends Model
{
    /**
     * Get the user that owns the car.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}