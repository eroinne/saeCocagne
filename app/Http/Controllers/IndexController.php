<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     * Display the home page.
     * @return View
     */
    public function home(){
        return view('index');
    }


}
