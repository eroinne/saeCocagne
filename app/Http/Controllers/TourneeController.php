<?php

namespace App\Http\Controllers;

use App\Models\Depots;
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
        $allDepots = Depots::where('structures_id', $structures_id)->get();


        if($structure == null){
            return redirect()->route('staffs.tournees')->with('error', 'Aucune structure n\'a été trouvée');
        }

        return view('staffs.tournees', compact('tournees', 'structure', 'allDepots'));
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

        $allDepots = Depots::where('structures_id', $structures_id)->get();

        // Keep only depots not in the tournee
        $allDepots = $allDepots->filter(function ($depot) use ($tournee){
            $all_depot = explode(';', $tournee->point_depots);
            if(!in_array($depot->id, $all_depot)){
                return $depot;
            }
        });

        return view('staffs.edit-tournee', compact('tournee', 'structure', 'allDepots'));
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

    /**
     * Function to delete tournee
     * @param Request $request
     */
    public function deleteTournee(Request $request){
        $tournee = TournerLivraison::find($request->tournee_id);
        $structure = Structures::find($request->structures_id);

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

        $tournee->delete();

        return redirect()->route('staffs.tournee', $structure->id)->with('success', 'La tournée a bien été supprimée');
    }

    /**
     * Function to store tournee
     * @param Request $request
     */
    public function storeTournee(Request $request){
        $structure = Structures::find($request->structures_id);

        //Validate request
        $request->validate([
            'jour_preparation' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi',
            'jour_livraison' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi',
            'couleur' => 'required|in:red,blue,green,yellow,orange,purple,pink,black,brown,gray',
            'depot' => 'required',
        ]);

        if($structure == null){
            return redirect()->route('staffs.tournees')->with('error', 'Aucune structure n\'a été trouvée');
        }

        if(Auth::guard('staffs')->user()->canAct($structure->id) == 0){
            return redirect()->route('staffs.tournees')->with('error', 'Vous n\'avez pas les droits pour accéder à cette page');
        }



        $tournee = new TournerLivraison();
        $tournee->structures_id = $structure->id;
        $tournee->jour_preparation = $request->jour_preparation;
        $tournee->jour_livraison = $request->jour_livraison;
        $tournee->couleur = $request->couleur;

        $tournee->point_depots = $request->depot;

        $tournee->save();

        return redirect()->route('staffs.tournee', $structure->id)->with('success', 'La tournée a bien été ajoutée');

    }



    /**
     * Function to delete a depot in tournee
     * @param Request $request
     */
    public function deleteDepotTournee(Request $request){
        $tournee = TournerLivraison::find($request->tournee_id);
        $structure = Structures::find($request->structures_id);

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

        $depot_id = $request->depot_id;

        $all_depot = explode(';', $tournee->point_depots);

        $new_all_depot = [];
        foreach($all_depot as $depot){
            if($depot != $depot_id){
                $new_all_depot[] = $depot;
            }
        }

        $tournee->point_depots = implode(';', $new_all_depot);

        $tournee->save();

        return redirect()->route('staffs.tournee', $structure->id)->with('success', 'Le point de dépôt a bien été supprimé');
    }

    /**
     * Function to add depot in tournee
     * @param Request $request
     */
    public function storeDepotTournee(Request $request){

        $tournee = TournerLivraison::find($request->tournee_id);
        $structure = Structures::find($request->structures_id);

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
        $depot_id = $request->new_depot;

        $all_depot = explode(';', $tournee->point_depots);

        //Check if the depot is already in the tournee
        if(in_array($depot_id, $all_depot)){
            return redirect()->route('staffs.tournee.edit', ['structures_id' => $structure->id, 'tournee_id' => $tournee->id])->with('error', 'Le point de dépôt est déjà dans la tournée');
        }

        $new_all_depot = [];
        foreach($all_depot as $depot){
            $new_all_depot[] = $depot;
        }

        $new_all_depot[] = $depot_id;

        $tournee->point_depots = implode(';', $new_all_depot);

        $tournee->save();

        return redirect()->route('staffs.tournee.edit', ['structures_id' => $structure->id, 'tournee_id' => $tournee->id])->with('success', 'Le point de dépôt a bien été ajouté');
    }
}
