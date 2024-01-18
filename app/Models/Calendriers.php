<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Livraisons;
use Illuminate\Support\Facades\Http;
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
     * @return 1 if the generation is successful, 0 otherwise
     */
    public static function generateLivraisons($structure_id, $year)
    {

        //Check if the calendrier already exists
        $calendrier = Calendriers::where('structures_id', $structure_id)->where('annee', $year)->first();

        if (isset($calendrier)) {
            return 0;
        }else{

            $calendrier = Calendriers::create([
                'structures_id' => $structure_id,
                'annee' => (int) $year,
            ]);

        }
        // Get the start date for the year
        $startDate = Carbon::create($year, 1, 1);

        Carbon::setLocale('fr');

        $feries = self::getJoursFeries($structure_id, $year);

        // Create livraisons for each Tuesday, Wednesday, and Friday every 2 weeks
        for ($i = 0; $i < 52; $i++) {
            $deliveryDateTuesday = $startDate->copy()->addWeeks(2 * $i)->next(Carbon::TUESDAY);
            $deliveryDateWednesday = $startDate->copy()->addWeeks(2 * $i)->next(Carbon::WEDNESDAY);
            $deliveryDateFriday = $startDate->copy()->addWeeks(2 * $i)->next(Carbon::FRIDAY);

            // Check if we have completed all weeks of the current year
            if ($deliveryDateTuesday->year > $year) {
                break;
            }

            $deliveryDates = [
                $deliveryDateTuesday,
                $deliveryDateWednesday,
                $deliveryDateFriday,
            ];
            foreach ($deliveryDates as $deliveryDate) {
                // Convert the date to a string for use in creating the delivery
                $formattedDate = $deliveryDate->toDateString();

                // Check if the delivery day is a holiday
                if (array_key_exists($formattedDate, $feries)) {
                    $adjustedDate = $deliveryDate->copy();

                    // Save initial day of the livraison
                    $originalDay = $adjustedDate->isoFormat('dddd');

                    // Move to the next day if the holiday is not on a Friday
                    while ($adjustedDate->dayOfWeek != Carbon::FRIDAY && array_key_exists($adjustedDate->toDateString(), $feries)) {
                        $adjustedDate->addDay();
                    }

                    Livraisons::create([
                        'calendriers_id' => $calendrier->id,
                        'jour' => $originalDay, // Utiliser le nom du jour initial
                        'mois' => $adjustedDate->month,
                        'date' => $adjustedDate->toDateString(),
                        'numero_semaine' => $i == 0 ? 1 : $i * 2 + 1,
                    ]);
                } else {
                    // If it's not a holiday, create the delivery normally
                    Livraisons::create([
                        'calendriers_id' => $calendrier->id,
                        'jour' => $deliveryDate->isoFormat('dddd'),
                        'mois' => $deliveryDate->month,
                        'date' => $formattedDate,
                        'numero_semaine' => $i == 0 ? 1 : $i * 2 + 1,
                    ]);
                }
            }
        }

        return 1;
    }


    /**
     * Function to retrieve public holidays from the API
     *
     * @param $structure_id
     * @param $year
     * @return array
     */
    public static function getJoursFeries($structure_id)
    {

        $structure = Structures::find($structure_id);

        // Make the request to the API to retrieve public holidays
        $response = Http::get("https://calendrier.api.gouv.fr/jours-feries/" . $structure->zone . ".json");

        // Check if the request was successful
        if ($response->successful()) {
            return $response->json();
        }

        // In case of an error, return an empty array
        return [];
    }

}
