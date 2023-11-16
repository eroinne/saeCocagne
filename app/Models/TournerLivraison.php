<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournerLivraison extends Model
{
    use HasFactory;


    //belong to many depots
    /**
     * The depots that belong to the TournerLivraison
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function depots()
    {
        return $this->belongsToMany(Depots::class);
    }

    //has many commandes
    /**
     * Get all the commandes for the TournerLivraison
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandes()
    {
        return $this->hasMany(Commandes::class);
    }



}
