<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commandes extends Model
{
    use HasFactory;

    // belonge to adherent
    /**
     * Get the adherent that owns the commande.
     */
    public function adherent(): BelongsTo
    {
        return $this->belongsTo(Adherents::class);
    }

    // belonge to structure
    /**
     * Get the structure that owns the commande.
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structures::class);
    }

    // belonge to tournerLivraison
    /**
     * Get the tournerLivraison that owns the commande.
     */
    public function tournerLivraison(): BelongsTo
    {
        return $this->belongsTo(TournerLivraison::class);
    }

    // belonge to abonnement
    /**
     * Get the abonnement that owns the commande.
     */
    public function abonnements(): BelongsTo
    {
        return $this->belongsTo(Abonnements::class);
    }

    // belonge to produit
    /**
     * Get the produit that owns the commande.
     */
    public function produits(): BelongsTo
    {
        return $this->belongsTo(Produits::class);
    }






}
