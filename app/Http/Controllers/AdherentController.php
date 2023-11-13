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
}
