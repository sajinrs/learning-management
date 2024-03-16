<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct() {
		
	}

    public function index()
    {
        die('d');
        return view('front.home', $this->data);
    }


    


}
