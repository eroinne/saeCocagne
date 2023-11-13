<?php

namespace App\Http\Controllers;

use App\Models\Depots;
use Illuminate\Http\Request;

class DepositoryContorller extends Controller
{
    //add a depository
    /**
     * @param Request $request
     * @return string[]
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_structure' => 'required|numeric',
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'mail' => 'required|string|max:255|nullable',
            'web_site' => 'required|string|max:255|nullable',
            'delivery_day' => 'required|date',
            'delivery_hour' => 'required|date_format:H:i',
            'basket_hour' => 'required|date_format:H:i',
            'presentation_text' => 'required|string|max:255|nullable',
            'image_path' => 'required|string|max:255|nullable',
            'comment' => 'required|string|max:255|nullable',
        ]);

        $depository = new Depots();
        $depository->id_structure = $request->id_structure;
        $depository->nom = $request->name;
        $depository->ville = $request->city;
        $depository->adresse = $request->address;
        $depository->code_postal = $request->zip_code;
        $depository->telephone = $request->phone;
        $depository->mail = $request->mail;
        $depository->siteWeb = $request->web_site;
        $depository->jour_livraison = $request->delivery_day;
        $depository->heure_livraison = $request->delivery_hour;
        $depository->heure_paniers = $request->basket_hour;
        $depository->text_presentation = $request->presentation_text;
        $depository->chemin_image = $request->image_path;
        $depository->commentaire = $request->comment;
        $result = $depository->save();

        //TODO change wen view is complete
        if ($result) {
            return ["Result" => "Le dépot $depository->nom a bien été ajouté"];
        } else {
            return ["Result" => "Operation failed"];
        }
    }

    //update a depository

    /**
     * @param Request $request
     * @param $id
     * @return string[]
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_structure' => 'required|numeric',
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'mail' => 'required|string|max:255|nullable',
            'web_site' => 'required|string|max:255|nullable',
            'delivery_day' => 'required|date',
            'delivery_hour' => 'required|date_format:H:i',
            'basket_hour' => 'required|date_format:H:i',
            'presentation_text' => 'required|string|max:255|nullable',
            'image_path' => 'required|string|max:255|nullable',
            'comment' => 'required|string|max:255|nullable',
        ]);

        $depository = Depots::find($id);
        $depository->id_structure = $request->id_structure;
        $depository->nom = $request->name;
        $depository->ville = $request->city;
        $depository->adresse = $request->address;
        $depository->code_postal = $request->zip_code;
        $depository->telephone = $request->phone;
        $depository->mail = $request->mail;
        $depository->siteWeb = $request->web_site;
        $depository->jour_livraison = $request->delivery_day;
        $depository->heure_livraison = $request->delivery_hour;
        $depository->heure_paniers = $request->basket_hour;
        $depository->text_presentation = $request->presentation_text;
        $depository->chemin_image = $request->image_path;
        $depository->commentaire = $request->comment;
        $result = $depository->save();

        //TODO change wen view is complete
        if ($result) {
            return ["Result" => "Le dépot $depository->nom a bien été modifié"];
        } else {
            return ["Result" => "Operation failed"];
        }
    }

    //delete a depository

    /**
     * @param $id
     * @return string[]
     */
    public function destroy($id)
    {
        $depository = Depots::find($id);
        $nom_depository = $depository->nom;
        $result = $depository->delete();

        //TODO change wen view is complete
        if ($result) {
            return ["Result" => "Le dépot $nom_depository a bien été supprimé"];
        } else {
            return ["Result" => "Operation failed"];
        }
    }

}
