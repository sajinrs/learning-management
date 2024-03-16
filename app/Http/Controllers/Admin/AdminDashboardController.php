<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends AdminBaseController
{
    public function __construct() {	
		parent::__construct();

		$this->middleware('role:admin');		
		$this->middleware(function ($request, $next) {
            return $next($request);
        });
	}


    public function index()
    {
        //die('dd');
        //$this->order = Order::count();
        return view('admin.dashboard', $this->data);
    }
}
