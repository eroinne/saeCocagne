<?php

namespace App\Http\Controllers;

use App\Models\Structures;
use Illuminate\Http\Request;
use App\Models\TournerLivraison;
use Illuminate\Support\Facades\Auth;

class TourneeController extends Controller
{

    /**
     * Function to return the list of tournees
     */
    public function tournees(){
        $structures = Structures::all();
        return view('staffs.list-tournee', compact('structures'));
    }

    /**
     * Function to return the list of tournees of the structure
     */
    public function tournee($structures_id){
        $tournees = TournerLivraison::where('structures_id', $structures_id)->get();
        $structure = Structures::find($structures_id);


        if($structure == null){
            return redirect()->route('staffs.tournees')->with('error', 'Aucune structure n\'a été trouvée');
        }

        return view('staffs.tournees', compact('tournees', 'structure'));
    }

    /**
     * Function to return view for edit tournee
     * @param $structures_id
     * @param $tournee_id
     */
    public function editTournee($structures_id, $tournee_id){
        $tournee = TournerLivraison::find($tournee_id);
        $structure = Structures::find($structures_id);

        if($tournee == null){
            return redirect()->route('staffs.tournees')->with('error', 'Aucune tournée n\'a été trouvée');
        }

        if($structure == null){
            return redirect()->route('staffs.tournees')->with('error', 'Aucune structure n\'a été trouvée');
        }

        if(Auth::guard('staffs')->user()->canAct($structure->id) == 0){
            return redirect()->route('staffs.tournees')->with('error', 'Vous n\'avez pas les droits pour accéder à cette page');
        }

        // Check if the structur->id and structures_id of the tournee is the same
        if($structure->id != $tournee->structures_id){
            return redirect()->route('staffs.tournees')->with('error', 'Vous n\'avez pas les droits pour accéder à cette page');
        }

        return view('staffs.edit-tournee', compact('tournee', 'structure'));
    }

}
