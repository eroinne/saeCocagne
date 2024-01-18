<?php

namespace App\Models;

use App\Models\Depots;
use App\Models\Commandes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TournerLivraison extends Model
{
    use HasFactory;

    public $table = 'tournees_de_livraison';


    protected $guarded = [];

    /**
     * The depots that belong to the TournerLivraison
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function depots()
    {
        return explode(';', $this->point_depots);
    }

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
