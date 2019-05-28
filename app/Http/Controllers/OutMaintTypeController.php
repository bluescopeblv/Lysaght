<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OutMaintType;

class OutMaintTypeController extends Controller
{
    public function getListAdmin()
    {
    	$types = OutMaintType::all();
    	return view('admin.outmaint.typelist',compact('types'));
    }

    public function getAddAdmin()
    {
    	return view('admin.outmaint.typeadd');
    }

    public function postAddAdmin(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required',
            'active'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên máy',
            'active.required'=>'Bạn chưa chọn active'
        ]);

        $type = new OutMaintType;
        $type->name = $request->name;
        $type->active = $request->active;
        $type->note = $request->note;
        $type->save();
        return redirect()->back()->with('thongbao','Thêm thành công');
    }

    public function getEditAdmin($id)
    {
    	$type = OutMaintType::find($id);
    	return view('admin.outmaint.typeedit', compact('type'));
    }

    public function postEditAdmin($id, Request $request)
    {
    	$this->validate($request,[
            'name' => 'required',
            'active'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên máy',
            'active.required'=>'Bạn chưa chọn active'
        ]);

        $type = OutMaintType::find($id);
        $type->name = $request->name;
        $type->active = $request->active;
        $type->note = $request->note;
        $type->save();
        return redirect()->back()->with('thongbao','Edit thành công');
    }
    
}
