<?php

namespace App\Http\Controllers;

use App\Models\Produits;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //add a product

    /**
     * @param Request $request
     * @return string[]
     */
    public function store(Request $request){
          $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
              'unit' => 'required|string|max:255|nullable',
              'unit_value' => 'required|string|max:255|nullable',
        ]);

        $product = new Produits();
        $product->nom = $request->name;
        $product->type = $request->type;
        $product->prix = $request->price;
        $product->unite = $request->unit;
        $product->valeur_unite = $request->unit_value;
        $result = $product->save();

        //TODO change wen view is complete
        if($result){
            return ["Result"=>"Le produit $product->nom a bien été ajouté"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }

    //delete a product

    /**
     * @param $id
     * @return string[]
     */
    public function destroy($id){
        $product = Produits::find($id);
        $nom_product = $product->nom;
        $result = $product->delete();

        //TODO change wen view is complete

        if($result){
            return ["Result"=>"Le produit $nom_product a été supprimé"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }
    //update a product

    /**
     * @param Request $request
     * @param $id
     * @return string[]
     */
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'unit' => 'required|string|max:255|nullable',
            'unit_value' => 'required|string|max:255|nullable',
        ]);
        $product = Produits::find($id);
        $product->nom = $request->name;
        $product->type = $request->type;
        $product->prix = $request->price;
        $product->unite = $request->unit;
        $product->valeur_unite = $request->unit_value;
        $result = $product->save();
        //TODO change wen view is complete
        if($result){
            return ["Result"=>"Le produit $product->nom a été mis à jour"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }
}
