<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depots extends Model
{
    use HasFactory;

    public $table = 'depot';

    /**
     * Get the structure that owns the depots.
     */
    public function structure()
    {
        return $this->belongsTo(Structures::class);
    }

    public function tournerLivraison()
    {
        return $this->belongsToMany(TournerLivraison::class);
    }



}
