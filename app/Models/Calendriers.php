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

        // Create livraisons for each Tuesday every 2 weeks
        for ($i = 0; $i < 52; $i++) {
            $deliveryDate = $startDate->copy()->addWeeks(2 * $i)->next(Carbon::TUESDAY);

            // Check if we have completed all weeks of the current year
            if ($deliveryDate->year > $year) {
                break;
            }

            // Adjust for holidays (you need to implement your holiday logic)
            // if ($this->isHoliday($deliveryDate)) {
            //     $deliveryDate = $deliveryDate->nextBusinessDay();
            // }



            // Create Livraisons record
            Livraisons::create([
                'calendriers_id' => $calendrier->id,
                'jour' => $deliveryDate->day,
                'mois' => $deliveryDate->month,
                'date' => $deliveryDate->toDateString(),
                'numero_semaine' => $i == 0 ? 1 : $i*2 + 1,
            ]);
        }

    }

}
