<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnements extends Model
{
    use HasFactory;

    //belonge to  manyadherent
    /**
     * Get the adherent that owns the abonnement.
     */
    public function adherents()
    {
        return $this->hasMany(Adherents::class);
    }

    //belonge to  structure
    /**
     * Get the structure that owns the abonnement.
     */
    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    //belong to many panier
    /**
     * Get the paniers associated with the abonnement.
     */
    public function paniers()
    {
        return $this->belongsToMany(Panier::class);
    }

    //has many commandes
    /**
     * Get all of the commandes for the Abonnements
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
