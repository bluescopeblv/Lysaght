<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\TheLoai;
use App\User;

class PhonebookController extends Controller
{
	function __construct()
	{
	
	}

    public function getPhonebook()
    {
        return view('pages.phonebook.danhsach');
    }

    public function postPhonebook(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'name.required'=>'* Bạn chưa nhập tên',
        ]);
        $user = User::where('name','like',"%$request->name%")->paginate();      
        return view('pages.phonebook.danhsach',compact('user'));
    }


}
