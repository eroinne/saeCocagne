<?php

namespace App\Http\Controllers;

use App\Models\Depots;
use App\Models\Structures;
use Illuminate\Http\Request;

class DepotController extends Controller
{

    /**
     * Function to return the view of the list of depots
     * @return View
     */
    public function depots(){
        $depots = Depots::all();
        $structures = Structures::all();
        return view('staffs.list-depot', compact('depots', 'structures'));
    }

    /**
     * Function to return the view of all the depot of a structure
     * @param $structures_id
     * @return View
     */
    public function depot($structures_id){
        $depots = Depots::where('structures_id', $structures_id)->get();

        $structure = Structures::find($structures_id);

        if($structure == null)
            return redirect()->route('staffs.depots')->with('error', 'La structure n\'existe pas');


        return view('staffs.depots', compact('depots', 'structure'));
    }



}
