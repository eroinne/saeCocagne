<?php

namespace App\Http\Controllers;

use App\Models\Adherents;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdherentController extends Controller
{


    /**
     * Function to return the dashboard view
     * @return View
     */
    public function dashboard(){
        return view('adherents.dashboard');
    }


    /**
     * Function to return the account view
     * @return View
     */
    public function account(){
        return view('adherents.account');
    }


    /**
     * Function to return the shop view
     * @return View
     */
    public function shop(){
        return view('adherents.shop');
    }

    /**
     * Update the user's profile information.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'raison_sociale' => ['required', 'string', 'max:255'],
            'civilite' => ['required', 'string', 'max:255', Rule::in(['mme', 'mr'])],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(Adherents::class)->ignore($user->id)],
            'ville' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'code_postal' => ['required', 'numeric'],
            'numero_telephone' => ['required', 'numeric', 'regex:/^0[1-9]\d{8}$/'],
            'numero_telephone2' => ['nullable', 'numeric', 'regex:/^0[1-9]\d{8}$/'],
            'numero_telephone3' => ['nullable', 'numeric', 'regex:/^0[1-9]\d{8}$/'],
            'profession' => ['nullable', 'string', 'max:255'],
            'date_naissance' => ['nullable', 'date'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $photo = $request->file('photo');

        if($photo != null)
            $base64Photo = base64_encode(file_get_contents($photo));
        else
            $base64Photo = $user->photo;

        $user->update([
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
            'photo' => $base64Photo,
        ]);

        if($user->save()){
            return back()->with('success', 'Votre profil a bien été mis à jour.');
        }else{
            return back()->with('error', 'Une erreur est survenue lors de la mise à jour de votre profil.');
        }

    }
}
