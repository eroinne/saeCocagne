<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paniers extends Model
{
    use HasFactory;


    //belog to many abonnements
    public function abonnements()
    {
        return $this->belongsToMany(Abonnements::class);
    }

    //belong to structure
    /**
     * Get the structure that owns the panier.
     */
    public function structure()
    {
        return $this->belongsTo(Structures::class);
    }

    //belong to many produits
    /**
     * The produits that belong to the Paniers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function produits()
    {
        return $this->belongsToMany(Produits::class);
    }

    //belong to many panier utilisateur
    /**
     * Get the paniers associated with the Paniers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function panierUtilisateur()
    {
        return $this->belongsToMany(PanierUtilisateur::class);
    }

    //belong to many commandes
    /**
     * Get the commandes associated with the Paniers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function commandes()
    {
        return $this->belongsToMany(Commandes::class);
    }

}
