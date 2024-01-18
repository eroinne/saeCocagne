<?php

namespace App\Http\Controllers;

use App\Models\Structures;
use Illuminate\Http\Request;

class StructuresController extends Controller
{
    //add a strucutre
    /**
     * @param Request $request
     * @return string[]
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'social_reason' => 'required|string|max:255',
            'social_headquarters' => 'required|string|max:255',
            'manager_address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'mail' => 'required|string|max:255',
            'referent_name' => 'required|string|max:255|nullable',
            'web_site' => 'required|string|max:255',
        ]);

        $structure = new Structures();
        $structure->nom = $request->name;
        $structure->type = $request->city;
        $structure->mail = $request->mail;
        $structure->telephone = $request->phone;
        $structure->site_web = $request->web_site;
        $structure->raison_sociale = $request->social_reason;
        $structure->siege_social = $request->social_headquarters;
        $structure->nom_referent = $request->referent_name;
        $structure->adresse_gestion = $request->manager_address;
        $result = $structure->save();

        //TODO change wen view is complete
        if($result){
            return ["Result"=>"La structrure $structure->nom a bien été ajouté"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }

    //update a structure

    /**
     * @param Request $request
     * @param $id
     * @return string[]
     */
    public function update(Request $request, $id){
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'social_reason' => 'required|string|max:255',
            'social_headquarters' => 'required|string|max:255',
            'manager_address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'mail' => 'required|string|max:255',
            'referent_name' => 'required|string|max:255|nullable',
            'web_site' => 'required|string|max:255',
        ]);

        $structure = Structures::find($id);
        $structure->nom = $request->name;
        $structure->type = $request->city;
        $structure->mail = $request->mail;
        $structure->telephone = $request->phone;
        $structure->site_web = $request->web_site;
        $structure->raison_sociale = $request->social_reason;
        $structure->siege_social = $request->social_headquarters;
        $structure->nom_referent = $request->referent_name;
        $structure->adresse_gestion = $request->manager_address;
        $result = $structure->save();

        //TODO change wen view is complete
        if($result){
            return ["Result"=>"La structure $structure->nom a bien été modifié"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }


    //delete a structure
    /**
     * @param $id
     * @return string[]
     */
    public function destroy($id){
        $structure = Structures::find($id);
        $nom_structure = $structure->nom;
        $result = $structure->delete();

        //TODO change wen view is complete

        if($result){
            return ["Result"=>"La structure $nom_structure a été supprimé"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }




}
