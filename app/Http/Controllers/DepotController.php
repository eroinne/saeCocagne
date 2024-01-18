<?php

namespace App\Http\Controllers;

use App\Models\Depots;
use App\Models\Structures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    /**
     * Fonction pour mettre à jour un dépôt
     * @param Request $request
     * @param $structures_id
     * @return Redirect
     */
    public function updateDepot(Request $request){


        // Validation
        $request->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string',
            'telephone' => 'required|string|max:255',
            'mail' => 'nullable|email|max:255',
            'siteWeb' => 'nullable|string|max:255',
            'mail_referent' => 'required|email|max:255',
            'telephone_referent' => 'required|string|max:255',
            'jour_livraison' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi',
            'heure_livraison' => 'required|date_format:H:i:s',
            'heure_paniers' => 'required|date_format:H:i:s',
            'text_presentation' => 'nullable|string|max:255',
            'commentaire' => 'nullable|string|max:255',
        ]);

        $structure = Structures::find($request->structures_id);

        // Check if user has the rights to edit the structure
        if(Auth::guard('staffs')->user()->canAct($structure->id) == 0)
            return back()->with('error', 'Vous n\'avez pas les droits pour modifier ce dépôt');

        $depot = Depots::find($request->depot_id);

        if ($depot == null) {
            return back()->with('error', 'Le dépôt n\'existe pas');
        }

        // Check if structures_id is the same than structure->id
        if($structure->id != $depot->structures_id)
            return back()->with('error', 'Vous n\'avez pas les droits pour modifier ce dépôt');


        // Update the depot
        $depot->nom = $request->nom;
        $depot->ville = $request->ville;
        $depot->adresse = $request->adresse;
        $depot->code_postal = $request->code_postal;
        $depot->telephone = $request->telephone;
        $depot->mail = $request->mail;
        $depot->siteWeb = $request->siteWeb;
        $depot->mail_referent = $request->mail_referent;
        $depot->telephone_referent = $request->telephone_referent;
        $depot->jour_livraison = $request->jour_livraison;
        $depot->heure_livraison = $request->heure_livraison;
        $depot->heure_paniers = $request->heure_paniers;
        $depot->text_presentation = $request->text_presentation;
        $depot->commentaire = $request->commentaire;

        // Save
        if($depot->save())
            return back()->with('success', 'Le dépôt a bien été modifié');
        else
            return back()->with('error', 'Une erreur est survenue lors de la modification du dépôt');
    }


    /**
     * Function to create a new depot
     * @param Request $request
     * @return Redirect
     */
    public function storeDepot(Request $request) {

        // Validation
        $request->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string',
            'telephone' => 'required|string|max:255',
            'mail' => 'nullable|email|max:255',
            'siteWeb' => 'nullable|string|max:255',
            'mail_referent' => 'required|email|max:255',
            'telephone_referent' => 'required|string|max:255',
            'jour_livraison' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi',
            'heure_livraison' => 'required|date_format:H:i:s',
            'heure_paniers' => 'required|date_format:H:i:s',
            'text_presentation' => 'nullable|string|max:255',
            'commentaire' => 'nullable|string|max:255',
        ]);

        // Get the structure
        $structure = Structures::find($request->structures_id);

        // Check if the user has the rights to create a depot
        if (Auth::guard('staffs')->user()->canAct($structure->id) == 0)
            return back()->with('error', 'Vous n\'avez pas les droits pour créer un dépôt');

        // Create a new depot
        $depot = new Depots();
        $depot->structures_id = $structure->id;
        $depot->nom = $request->nom;
        $depot->ville = $request->ville;
        $depot->adresse = $request->adresse;
        $depot->code_postal = $request->code_postal;
        $depot->telephone = $request->telephone;
        $depot->mail = $request->mail;
        $depot->siteWeb = $request->siteWeb;
        $depot->mail_referent = $request->mail_referent;
        $depot->telephone_referent = $request->telephone_referent;
        $depot->jour_livraison = $request->jour_livraison;
        $depot->heure_livraison = $request->heure_livraison;
        $depot->heure_paniers = $request->heure_paniers;
        $depot->text_presentation = $request->text_presentation;
        $depot->commentaire = $request->commentaire;

        // Save the new depot
        if ($depot->save())
            return back()->with('success', 'Le dépôt a bien été créé');
        else
            return back()->with('error', 'Une erreur est survenue lors de la création du dépôt');
    }


    /**
     * Function to delete a depot
     * @param Request $request
     * @return Redirect
     */
    public function deleteDepot(Request $request){

        // Validation
        $request->validate([
            'depot_id' => 'required|integer',
            'structures_id' => 'required|integer',
        ]);

        // Get the depot
        $depot = Depots::find($request->depot_id);

        // Check if the depot exists
        if($depot == null)
            return back()->with('error', 'Le dépôt n\'existe pas');

        $structure = Structures::find($request->structures_id);

        if($structure->id != $depot->structures_id)
            return back()->with('error', 'Le dépôt n\'existe pas');

        // Check if the user has the rights to delete the depot
        if(Auth::guard('staffs')->user()->canAct($structure->id) == 0)
            return back()->with('error', 'Vous n\'avez pas les droits pour supprimer ce dépôt');

        // Delete the depot
        if($depot->delete())
            return back()->with('success', 'Le dépôt a bien été supprimé');
        else
            return back()->with('error', 'Une erreur est survenue lors de la suppression du dépôt');
    }



}
