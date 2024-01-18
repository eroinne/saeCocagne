<?php

namespace App\Http\Controllers;

use App\Models\TournerLivraison;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{


    public function store(Request $request){
        $request->validate([
            'id_structure' => 'required|numeric',
            'days_delivery' => 'required|date|after:dateline_start',
            'days_preparation' => 'required|date|before:dateline_end',
            'color' => 'required|string|max:255',
            'repositories' => 'required|string|max:500',

        ]);

        $delivery = new TournerLivraison();
        $delivery->id_structure = $request->id_structure;
        $delivery->date_livraison = $request->days_delivery;
        $delivery->date_preparation = $request->days_preparation;
        $delivery->couleur = $request->color;
        $delivery->point_depots = $request->repositories;
        $result = $delivery->save();

        //TODO change wen view is complete
        if($result){
            return ["Result"=>"La tourner de livraison a bien été ajouté"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }

    //update a delivery

    public function update(Request $request, $id){
        $request->validate([
            'id_structure' => 'required|numeric',
            'days_delivery' => 'required|date|after:dateline_start',
            'days_preparation' => 'required|date|before:dateline_end',
            'color' => 'required|string|max:255',
            'repositories' => 'required|string|max:500',

        ]);

        $delivery = TournerLivraison::find($id);
        $delivery->id_structure = $request->id_structure;
        $delivery->date_livraison = $request->days_delivery;
        $delivery->date_preparation = $request->days_preparation;
        $delivery->couleur = $request->color;
        $delivery->point_depots = $request->repositories;
        $result = $delivery->save();

        //TODO change wen view is complete
        if($result){
            return ["Result"=>"La tourner de livraison a bien été modifié"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }

    //delete a delivery

    public function destroy($id){
        $delivery = TournerLivraison::find($id);
        $id_delivery = $delivery->id;
        $result = $delivery->delete();

        //TODO change wen view is complete
        if($result){
            return ["Result"=>"La tourner de livraison numero : $id_delivery  a bien été supprimé"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }

    //show a delivery

    public function show($id)
    {
        $delivery = TournerLivraison::find($id);
        return $delivery;
    }

    //show all delivery

    public function index()
    {
        $delivery = TournerLivraison::all();
        return $delivery;
    }



}
