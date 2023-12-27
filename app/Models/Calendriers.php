<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Livraisons;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calendriers extends Model
{
    use HasFactory;

    protected $guarded = [];

    //has one structure
    /**
     * Get the structure taht owns the calandar.
     */
    public function structure()
    {
        return $this->belongsTo(Structures::class);
    }

    //has many tournerLivraison
    /**
     * Get the tournerLivraison associated with the structure.
     */
    public function tournerLivraison()
    {
        return $this->hasMany(TournerLivraison::class);
    }

    /**
     * Get the livraisons associated with the calendrier.
     */
    public function livraisons()
    {
        return $this->hasMany(Livraisons::class);
    }

    /**
     * Function to generate all the livraisons of the calendriers
     * @param $structure_id
     * @param $year
     */
    public static function generateLivraisons($structure_id, $year)
{
    // Create a calendrier with the structure_id and the year
    $calendrier = Calendriers::create([
        'structures_id' => $structure_id,
        'annee' => $year,
    ]);

    // Get the start date for the year
    $startDate = Carbon::create($year, 1, 1);

    Carbon::setLocale('fr');

    // Create livraisons for each Tuesday, Wednesday, and Friday every 2 weeks
    for ($i = 0; $i < 52; $i++) {
        $deliveryDateTuesday = $startDate->copy()->addWeeks(2 * $i)->next(Carbon::TUESDAY);
        $deliveryDateWednesday = $startDate->copy()->addWeeks(2 * $i)->next(Carbon::WEDNESDAY);
        $deliveryDateFriday = $startDate->copy()->addWeeks(2 * $i)->next(Carbon::FRIDAY);

        // Check if we have completed all weeks of the current year
        if ($deliveryDateTuesday->year > $year) {
            break;
        }

        // Create Livraisons record for Tuesday
        Livraisons::create([
            'calendriers_id' => $calendrier->id,
            'jour' => $deliveryDateTuesday->isoFormat('dddd'),
            'mois' => $deliveryDateTuesday->month,
            'date' => $deliveryDateTuesday->toDateString(),
            'numero_semaine' => $i == 0 ? 1 : $i * 2 + 1,
        ]);

        // Create Livraisons record for Wednesday
        Livraisons::create([
            'calendriers_id' => $calendrier->id,
            'jour' => $deliveryDateWednesday->isoFormat('dddd'),
            'mois' => $deliveryDateWednesday->month,
            'date' => $deliveryDateWednesday->toDateString(),
            'numero_semaine' => $i == 0 ? 1 : $i * 2 + 1,
        ]);

        // Create Livraisons record for Friday
        Livraisons::create([
            'calendriers_id' => $calendrier->id,
            'jour' => $deliveryDateFriday->isoFormat('dddd'),
            'mois' => $deliveryDateFriday->month,
            'date' => $deliveryDateFriday->toDateString(),
            'numero_semaine' => $i == 0 ? 1 : $i * 2 + 1,
        ]);
    }
}

}
