<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use App\Models\Adherents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffsController extends Controller
{

    /**
     * Display the panel view
     */
    public function panel(){
        return view('staffs.panel');
    }

    /**
     * Display the staffs account view
     */
    public function account(){
        return view('staffs.account');
    }

    /**
     * Display all adherents list
     * @return View
    */
    public function adherents(){
        $adherents = Adherents::all();
        return view('staffs.list-adherents', compact('adherents'));
    }

    /**
     * Display the adherent info view
     * @param $id
     * @return View
     */
    public function adherent($id){
        $adherent = Adherents::find($id);
        return view('staffs.adherent-info', compact('adherent'));
    }

    /**
     * Function to update the staff member account
     * @param Request $request
     */
    public function update(Request $request){

        //Check if the id of the request is the id of the staff member or if the staff member is an administator
        if($request->id != Auth::guard('staffs')->user()->id && Auth::user()->is_admin != 0){
            return redirect()->route('staffs.account')->with('error', 'Vous ne pouvez pas modifier ce compte');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $staff = Staffs::find($request->id);
        $staff->nom = $request->nom;
        $staff->prenom = $request->prenom;
        $staff->email = $request->email;
        if($staff->save()){
            return redirect()->route('staffs.account')->with('success', 'Votre compte a bien été mis à jour');
        }else{
            return redirect()->route('staffs.account')->with('error', 'Une erreur est survenue lors de la mise à jour de votre compte');
        }


    }


    /**
     * Function to update the adherent account info
     * @param Request $request
     * @param $id
     */
    public function updateAdherent(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'raison_sociale' => 'required|string|max:255',
            'civilite' => 'required|string|max:255',
            'email' => 'required|email',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|numeric',
            'numero_telephone' => 'required|numeric|regex:/^0[1-9]\d{8}$/',
            'numero_telephone2' => 'nullable|numeric|regex:/^0[1-9]\d{8}$/',
            'numero_telephone3' => 'nullable|numeric|regex:/^0[1-9]\d{8}$/',
            'profession' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $adherent = Adherents::find($id);
        $adherent->name = $request->name;
        $adherent->prenom = $request->prenom;
        $adherent->raison_sociale = $request->raison_sociale;
        $adherent->civilite = $request->civilite;
        $adherent->email = $request->email;
        $adherent->ville = $request->ville;
        $adherent->adresse = $request->adresse;
        $adherent->code_postal = $request->code_postal;
        $adherent->numero_telephone = $request->numero_telephone;
        $adherent->numero_telephone2 = $request->numero_telephone2;
        $adherent->numero_telephone3 = $request->numero_telephone3;
        $adherent->profession = $request->profession;
        $adherent->date_naissance = $request->date_naissance;

        $adherent->update([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'raison_sociale' => $request->raison_sociale,
            'civilite' => $request->civilite,
            'email' => $request->email,
            'ville' => $request->ville,
            'adresse' => $request->adresse,
            'code_postal' => $request->code_postal,
            'numero_telephone' => $request->numero_telephone,
            'numero_telephone2' => $request->numero_telephone2,
            'numero_telephone3' => $request->numero_telephone3,
            'profession' => $request->profession,
            'date_naissance' => $request->date_naissance,
        ]);

        if($adherent->save()){
            return redirect()->route('staffs.adherent', $id)->with('success', 'Le compte de l\'adhérent a bien été mis à jour');
        }else{
            return redirect()->route('staffs.adherent', $id)->with('error', 'Une erreur est survenue lors de la mise à jour du compte de l\'adhérent');
        }

    }



    /**
     * Function to delete the adherent photo
     * @param $id
     */
    public function deletePhotoAdherent($id){
        $adherent = Adherents::find($id);
        $adherent->photo = null;
        if($adherent->save()){
            return back()->with('success', 'La photo a bien été supprimée');
        }else{
            return back()->with('error', 'Une erreur est survenue lors de la suppression de la photo');
        }

    }

    /**
    * to delete a staff membe
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $staff = Staffs::find($id);
        $nom_staff = $staff->nom;
        $result = $staff->delete();


        if ($result) {
            return redirect()->route('staffs.list')->with('success', "Le membre du staff $nom_staff a été supprimé");
        } else {
            return redirect()->route('staffs.list')->with('error', "Une erreur est survenue lors de la suppression du membre du staff $nom_staff");
        }

    }


}

