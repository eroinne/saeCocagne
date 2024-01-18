<?php

namespace App\Http\Controllers;

use App\Models\Livraisons;
use App\Models\Structures;
use App\Models\Calendriers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if($structure == null)
            return redirect()->route('staffs.depots')->with('error', 'La structure n\'existe pas');


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

            $structure = Structures::where('id', $request->structures_id)->first();

            if (!$structure) {
                // If nothing found
                return back()->with('error', 'Structure non trouvée');
            }

            if(Auth::guard('staffs')->user()->canAct($structure->id) == 0)
                return back()->with('error', 'Vous n\'avez pas les droits pour modifier ce dépôt');


            // Get the livraison
            $livraison = Livraisons::where('id', $request->livraison_id)->first();

            if (!$livraison) {
                // If nothing found
                return back()->with('error', 'Livraison non trouvée');
            }


            if(!$request->input('newDate')){
                // If nothing found
                return back()->with('error', 'Veuillez renseigner une date');
            }

            // Update the date of livraison
            $livraison->date = $request->input('newDate');

            // Get the calendrier of the year for the structure
            $calendrier = Calendriers::where('structures_id', $structure->id)->where('annee', date('Y', strtotime($request->input('newDate'))))->first();



            if(!$calendrier){
                // If nothing found
                return back()->with('error', 'Calendrier non trouvé pour l\'année sélectionnée: ' . date('Y', strtotime($request->input('newDate'))));
            }

            // Get the number of the week in the year, and the number of the month
            $week = date('W', strtotime($request->input('newDate')));
            $month = date('m', strtotime($request->input('newDate')));

            // Get the name of the day in french
            $day = date('l', strtotime($request->input('newDate')));

            switch ($day) {
                case 'Monday':
                    $day = 'lundi';
                    break;
                case 'Tuesday':
                    $day = 'mardi';
                    break;
                case 'Wednesday':
                    $day = 'mercredi';
                    break;
                case 'Thursday':
                    $day = 'jeudi';
                    break;
                case 'Friday':
                    $day = 'vendredi';
                    break;
                case 'Saturday':
                    $day = 'samedi';
                    break;
                case 'Sunday':
                    $day = 'dimanche';
                    break;
            }

            // Update the week and month of the livraison
            $livraison->numero_semaine = $week;
            $livraison->mois = $month;
            $livraison->jour = $day;
            $livraison->calendriers_id = $calendrier->id;

            $livraison->save();

            // Succes response
            return back()->with('success', 'Livraison mise à jour avec succès');
        } catch (\Exception $e) {
            // Error response
            return back()->with('error', 'Une erreur est survenue lors de la mise à jour de la livraison');
        }
    }

    /**
     * Function to store a new livraison
     * @param Request $request
     */
    public function storeLivraison(Request $request)
    {
        try {
            // Get the structure
            $structure = Structures::where('id', $request->structures_id)->first();

            if (!$structure) {
                // If nothing found
                return back()->with('error', 'Structure non trouvée');
            }

            if(Auth::guard('staffs')->user()->canAct($structure->id) == 0)
                return back()->with('error', 'Vous n\'avez pas les droits pour modifier ce dépôt');


            if(!$request->input('date')){
                // If nothing found
                return back()->with('error', 'Veuillez renseigner une date');
            }

            // Create a new livraison
            $livraison = new Livraisons();

            // Get the date of the livraison
            $livraison->date = $request->input('date');

            // Get the calendrier of the year for the structure
            $calendrier = Calendriers::where('structures_id', $structure->id)->where('annee', date('Y', strtotime($request->input('date'))))->first();

            if(!$calendrier){
                // If nothing found
                return back()->with('error', 'Calendrier non trouvé pour l\'année sélectionnée: ' . date('Y', strtotime($request->input('date'))));
            }

            // Get the number of the week in the year, and the number of the month
            $week = date('W', strtotime($request->input('date')));
            $month = date('m', strtotime($request->input('date')));

            // Get the name of the day in french
            $day = date('l', strtotime($request->input('date')));


            switch ($day) {
                case 'Monday':
                    $day = 'lundi';
                    break;
                case 'Tuesday':
                    $day = 'mardi';
                    break;
                case 'Wednesday':
                    $day = 'mercredi';
                    break;
                case 'Thursday':
                    $day = 'jeudi';
                    break;
                case 'Friday':
                    $day = 'vendredi';
                    break;
                case 'Saturday':
                    $day = 'samedi';
                    break;
                case 'Sunday':
                    $day = 'dimanche';
                    break;
            }

            // Get the week and month of the livraison
            $livraison->numero_semaine = (int) $week;
            $livraison->mois = (int) $month;
            $livraison->jour = $day;



            $livraison->calendriers_id = $calendrier->id;


            $livraison->save();

            // Succes response
            return back()->with('success', 'Livraison ajoutée avec succès');
        } catch (\Exception $e) {
            // Error response
            return back()->with('error', 'Une erreur est survenue lors de l\'ajout de la livraison');
        }
    }

    /**
     * Function to delete a livraison
     * @param Request $request
     */
    public function deleteLivraison(Request $request)
    {
        try {

            $structure = Structures::where('id', $request->structures_id)->first();

            if (!$structure) {
                // If nothing found
                return back()->with('error', 'Structure non trouvée');
            }

            if(Auth::guard('staffs')->user()->canAct($structure->id) == 0)
                return back()->with('error', 'Vous n\'avez pas les droits pour modifier ce dépôt');

            // Get the livraison
            $livraison = Livraisons::where('id', $request->livraison_id)->first();

            if (!$livraison) {
                // If nothing found
                return back()->with('error', 'Livraison non trouvée');
            }

            // Delete the livraison
            $livraison->delete();

            // Succes response
            return back()->with('success', 'Livraison supprimée avec succès');
        } catch (\Exception $e) {
            // Error response
            return back()->with('error', 'Une erreur est survenue lors de la suppression de la livraison');
        }
    }


    /**
     * Function to generate the livraison of a structure for a year
     * @param Request $request
     */
    public function genererLivraison(Request $request)
    {
        try {

            $structure = Structures::where('id', $request->structures_id)->first();

            if (!$structure) {
                // If nothing found
                return back()->with('error', 'Structure non trouvée');
            }

            // Check if the user is admin
            if(Auth::guard('staffs')->user()->canAct($structure->id) == 0)
                return back()->with('error', 'Vous n\'avez pas les droits pour modifier ce dépôt');


            //Check if the year is set
            if(!$request->input('year')){
                // If nothing found
                return back()->with('error', 'Veuillez renseigner une année');
            }

            //Check if the year is 20 year in past max or 5 in futur max
            if($request->input('year') < date('Y') - 20 || $request->input('year') > date('Y') + 5){
                // If nothing found
                return back()->with('error', 'Veuillez renseigner une année entre ' . (date('Y') - 20) . ' et ' . (date('Y') + 5));
            }

            $response = Calendriers::generateLivraisons($structure->id, $request->input('year'));


            if($response == 0){
                // Error response
                return back()->with('error', 'Une erreur est survenue lors de la génération des livraisons');
            }else{
                // Succes response
                return back()->with('success', 'Livraisons générées avec succès');
            }

        } catch (\Exception $e) {
            // Error response
            return back()->with('error', 'Une erreur est survenue lors de la génération des livraisons');
        }
    }
}
