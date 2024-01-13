<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Staffs;
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

class RegisteredStaffsController extends Controller
{

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Staffs::class],
            'is_admin' => ['required', 'boolean'],
            'structures_id' => ['required', 'numeric'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $staffs = Staffs::create([
            'nom' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
            'structures_id' => $request->structures_id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($staffs));

        Auth::guard('staffs')->login($staffs);

        return redirect(route('staffs.dashboard'));
    }


}
