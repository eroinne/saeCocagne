<?php

namespace App\Models;

use App\Models\Structures;
use App\Models\TournerLivraison;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
