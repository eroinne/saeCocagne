<?php

namespace App\Http\Controllers;

use App\Models\Paniers;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * Function to display the cart of the Adherent
     */
    public function displayCart(){
        return view('adherents.cart');
    }


    /**
     * Function to add element on cart
     * @param Request $request
     * @return string[]
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'id_structure' => 'required|numeric',

        ]);

        $panier = new Paniers();
        $panier->id_structure = $request->id_structure;
        $panier->nom = $request->name;
        $panier->type = $request->type;
        $panier->abonnements = $request->abonnements;
        $result = $panier->save();

        //TODO change wen view is complete
        if($result){
            return ["Result"=>"Le panier $panier->nom a bien été ajouté"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }

    //update a shopping cart
    /**
     * @param Request $request
     * @param $id
     * @return string[]
     */
    public function update(Request $request, $id){
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'id_structure' => 'required|numeric',


        ]);

        $panier = Paniers::find($id);
        $panier->id_structure = $request->id_structure;
        $panier->nom = $request->name;
        $panier->type = $request->type;
        $panier->abonnements = $request->abonnements;
        $result = $panier->save();

        //TODO change wen view is complete
        if($result){
            return ["Result"=>"Le panier $panier->nom a bien été modifié"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }

    //delete a shopping cart
    /**
     * @param $id
     * @return string[]
     */
    public function destroy($id){
        $panier = Paniers::find($id);
        $nom_panier= $panier->nom;
        $result = $panier->delete();

        //TODO change wen view is complete
        if($result){
            return ["Result"=>"Le panier $nom_panier a bien été supprimé"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }

}
