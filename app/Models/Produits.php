<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    use HasFactory;

    //belong to many paniers
    /**
     * The paniers that belong to the Produits
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function paniers()
    {
        return $this->belongsToMany(Paniers::class);
    }

    //belong to many abonnements
    /**
     * The abonnements that belong to the Produits
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function abonnements()
    {
        return $this->belongsToMany(Abonnements::class);
    }

    //belong to structure
    /**
     * Get the structure that owns the Produits
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function structure()
    {
        return $this->belongsTo(Structures::class);
    }

    //has many commandes
    /**
     * Get all the commandes for the Produits
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandes()
    {
        return $this->hasMany(Commandes::class);
    }

    //belong to many panier utilisateur
    /**
     * Get the paniers associated with the Produits
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function panierUtilisateur()
    {
        return $this->belongsToMany(PanierUtilisateur::class);
    }

}
