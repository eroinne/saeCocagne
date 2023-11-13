<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
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
        return $this->belongsTo(Structure::class);
    }

    //belong to many produits
    /**
     * The produits that belong to the Panier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function produits()
    {
        return $this->belongsToMany(Produits::class);
    }

}
