<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //add a shopping cart
    /**
     * @param Request $request
     * @return string[]
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'id_structure' => 'required|numeric',

        ]);

        $panier = new Panier();
        $panier->id_structure = $request->id_structure;
        $panier->nom = $request->name;
        $panier->type = $request->type;
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

        $panier = Panier::find($id);
        $panier->id_structure = $request->id_structure;
        $panier->nom = $request->name;
        $panier->type = $request->type;
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
        $panier = Panier::find($id);
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
