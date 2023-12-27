<?php

namespace App\Models;

use App\Models\Calendriers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livraisons extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the calendriers that owns the livraison.
     */
    public function calendrier()
    {
        return $this->belongsTo(Calendriers::class);
    }

}
