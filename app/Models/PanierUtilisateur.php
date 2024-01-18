<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanierUtilisateur extends Model
{
    use HasFactory;

    // belonge to adherent
    /**
     * Get the adherent that owns the commande.
     */
    public function adherent()
    {
        return $this->belongsTo(Adherent::class);
    }

    //belonge to many panier
    /**
     * Get the paniers associated with the abonnement.
     */
    public function paniers()
    {
        return $this->belongsToMany(Paniers::class);
    }

    //belonge to many produits
    /**
     * Get the produits associated with the abonnement.
     */
    public function produits()
    {
        return $this->belongsToMany(Produits::class);
    }



}
