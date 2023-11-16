<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Structures extends Model
{
    use HasFactory;

    // has many paniers
    public function paniers(): HasMany
    {
        return $this->hasMany(Paniers::class);
    }

    // has many adherents
    public function adherents(): HasMany
    {
        return $this->hasMany(Adherents::class);
    }

    // has many produits
    public function produits(): HasMany
    {
        return $this->hasMany(Produits::class);
    }

    // has many abonnements
    public function abonnements(): HasMany
    {
        return $this->hasMany(Abonnements::class);
    }

    //has many commandes
    public function commandes(): HasMany
    {
        return $this->hasMany(Commandes::class);
    }

    //has many tournerLivraison
    public function tournerLivraison(): HasMany
    {
        return $this->hasMany(TournerLivraison::class);
    }

    //has many depot
    /**
     * Get the depot associated with the structure.
     */
    public function depots(): HasMany
    {
        return $this->hasMany(Depots::class);
    }

    //has one calendrier
    /**
     * Get the calendrier associated with the structure.
     */
    public function calendrier()
    {
        return $this->hasOne(Calendrier::class);
    }

}
