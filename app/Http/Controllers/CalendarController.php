<?php

namespace App\Http\Controllers;

use App\Models\Livraisons;
use App\Models\Structures;
use App\Models\Calendriers;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Function to generate a calendar by year and structure id
     * @param int $year
     * @param int $structure_id
     */



     /**
     * Display the calendar info view
     * @return View
     */
    public function calendar($structures_id){
        //Get the calendar of the structure of the user
        $calendriers = Calendriers::where('structures_id', $structures_id)->get();

        //Get the structure of the calendrier
        $structure = Structures::where('id', $structures_id)->first();

        $cal = new Calendriers();

        //Get closed days
        $feries = $cal->getJoursFeries($structure->id);

        $feries = array_keys($feries);

        //Get the livraisons of all calendrier in calendriers
        $livraisons = array();
        foreach($calendriers as $calendrier){
            $livraisons[] = Livraisons::where('calendriers_id', $calendrier->id)->get();
        }

        return view('staffs.calendar',
            [
                'calendriers' => $calendriers,
                'structure' => $structure,
                'livraisons' => $livraisons,
                'feries' => $feries,
            ]
        );

    }


    /**
     * Display the view to edit the calendar of a structure
     * @param int $structures_id
     * @return View
     */
    public function editCalendar($structures_id){
        //Get the calendar of the structure of the user
        $calendriers = Calendriers::where('structures_id', $structures_id)->get();

        //Get the structure of the calendrier
        $structure = Structures::where('id', $structures_id)->first();

        $cal = new Calendriers();

        //Get closed days
        $feries = $cal->getJoursFeries($structure->id);

        $feries = array_keys($feries);

        //Get the livraisons of all calendrier in calendriers
        $livraisons = array();
        foreach($calendriers as $calendrier){
            $livraisons[] = Livraisons::where('calendriers_id', $calendrier->id)->get();
        }

        //Merge all livraisons in one array
        $livraisons = collect($livraisons)->flatten()
        ->sortByDesc(function ($livraison) {
            return $livraison->date;
        })
        ->all();

        return view('staffs.edit-calendar',
            [
                'calendriers' => $calendriers,
                'structure' => $structure,
                'livraisons' => $livraisons,
                'feries' => $feries,
            ]
        );
    }


    /**
     * Function to update the livraison of a structure
     * @param Request $request
     */
    public function updateLivraison(Request $request)
    {
        try {
            // Get the livraison
            $livraison = Livraisons::where('id', $request->livraison_id)->first();

            if (!$livraison) {
                // If nothing found
                return response()->json(['error' => 'Livraison non trouvée'], 404);
            }

            // Update the date of livraison
            $livraison->date = $request->input('newDate');

            // Get the number of the week in the year, and the number of the month
            $week = date('W', strtotime($request->input('newDate')));
            $month = date('m', strtotime($request->input('newDate')));

            // Get the name of the day in french
            $day = date('l', strtotime($request->input('newDate')));

            switch ($day) {
                case 'Monday':
                    $day = 'Lundi';
                    break;
                case 'Tuesday':
                    $day = 'Mardi';
                    break;
                case 'Wednesday':
                    $day = 'Mercredi';
                    break;
                case 'Thursday':
                    $day = 'Jeudi';
                    break;
                case 'Friday':
                    $day = 'Vendredi';
                    break;
                case 'Saturday':
                    $day = 'Samedi';
                    break;
                case 'Sunday':
                    $day = 'Dimanche';
                    break;
            }

            // Update the week and month of the livraison
            $livraison->numero_semaine = $week;
            $livraison->mois = $month;
            $livraison->jour = $day;

            $livraison->save();

            // Succes response
            return back()->with('success', 'Livraison mise à jour avec succès');
        } catch (\Exception $e) {
            // Error response
            return back()->with('error', 'Une erreur est survenue lors de la mise à jour de la livraison');
        }
    }
}
