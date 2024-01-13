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
                'livraisons' => $livraisons,
                'feries' => $feries,
            ]
        );

    }
}
