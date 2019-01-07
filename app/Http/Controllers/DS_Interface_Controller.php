<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DS_HR;
use App\DS_Safety;
use Carbon\Carbon;


class DS_Interface_Controller extends Controller
{
    //
    public function getInterface1()
    {
    	$hr = DS_HR::orderBy('id','DESC')->first();
        $safety = DS_Safety::orderBy('id','DESC')->first();
    	return view('pages.dashboard.interface.index', compact('hr','safety'));
    }

   

  

    
}
