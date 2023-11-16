<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Adherents;
use Illuminate\View\View;
use App\Models\Structures;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        // Get all the structure
        $structures = Structures::all();

        return view('auth.register', [
            'structures' => $structures,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom', ['required', 'string', 'max:255'],
            'raison_sociale', ['required', 'string', 'max:255'],
            'civilite', ['required', 'string', 'max:255', Rule::in(['Mme', 'M.'])],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Adherents::class],
            'ville', ['required', 'string', 'max:255'],
            'adresse', ['required', 'string', 'max:255'],
            'code_postal', ['required', 'numeric'],
            'numero_telephone', ['required', 'numeric'],
            'numero_telephone2', ['numeric'],
            'numero_telephone3', ['numeric'],
            'profession', ['string', 'max:255'],
            'date_naissance', ['date'],
            'structure_id', ['required', 'numeric'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Adherents::create([
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
            'structure_id' => $request->structure_id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
