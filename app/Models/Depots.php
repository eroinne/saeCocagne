<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depots extends Model
{
    use HasFactory;

    // belonge to structure
    /**
     * Get the structure that owns the depots.
     */
    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    //belong to many tournerLivraison
    public function tournerLivraison()
    {
        return $this->belongsToMany(TournerLivraison::class);
    }



}
