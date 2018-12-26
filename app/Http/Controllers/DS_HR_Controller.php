<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DS_HR;

class DS_HR_Controller extends Controller
{
    //
    public function get_List()
    {
    	$hr = DS_HR::all();
    	return view('pages.dashboard.hr.list', compact('hr'));
    }
}
