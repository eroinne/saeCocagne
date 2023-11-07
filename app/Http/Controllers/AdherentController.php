<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdherentController extends Controller
{


    /**
     * Function to return the dashboard view
     * @return View
     */
    public function dashboard(){
        return view('adherents.dashboard');
    }
}
