<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendrier extends Model
{
    use HasFactory;

    //has one structure
    /**
     * Get the structure taht owns the calandar.
     */
    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    //has many tournerLivraison
    /**
     * Get the tournerLivraison associated with the structure.
     */
    public function tournerLivraison()
    {
        return $this->hasMany(TournerLivraison::class);
    }

}
