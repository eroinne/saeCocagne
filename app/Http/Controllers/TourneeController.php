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

    /**
     * Function to update tournee
     * @param Request $request
     */
    public function updateTournee(Request $request){
        $tournee = TournerLivraison::find($request->tournee_id);
        $structure = Structures::find($request->structures_id);

        //Validate request
        $request->validate([
            'jour_preparation' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi',
            'jour_livraison' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi',
            'couleur' => 'required|in:red,blue,green,yellow,orange,purple,pink,black,brown,gray',
        ]);

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

        $tournee->jour_preparation = $request->jour_preparation;
        $tournee->jour_livraison = $request->jour_livraison;
        $tournee->couleur = $request->couleur;

        if ($request->filled('point_depots')) {
            //Check if the point_depots is number separated by ;
            $point_depots = explode(';', $request->point_depots);
            foreach($point_depots as $point_depot){
                if(!is_numeric($point_depot)){
                    return redirect()->route('staffs.tournee.edit', [$structure->id, $tournee->id])->with('error', 'Les points de dépôts doivent être des nombres séparés par un ;');
                }
            }


            $tournee->point_depots = $request->point_depots;
        }

        $tournee->save();

        return redirect()->route('staffs.tournee', $structure->id)->with('success', 'La tournée a bien été modifiée');

    }

}
