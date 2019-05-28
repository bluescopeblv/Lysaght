<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OutMaintType;
use App\OutMaintMachine;
use App\OutMaintActivity;

class OutMaintMachineController extends Controller
{
    public function getListAdmin()
    {
    	$machines = OutMaintMachine::all();
    	return view('admin.outmaint.machinelist',compact('machines'));
    }

    public function getAddAdmin()
    {
    	return view('admin.outmaint.machineadd');
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

        $type = new OutMaintMachine;
        $type->name = $request->name;
        $type->active = $request->active;
        $type->note = $request->note;
        $type->save();
        return redirect()->back()->with('thongbao','Thêm thành công');
    }

    public function getEditAdmin($id)
    {
    	$type = OutMaintMachine::find($id);
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

        $type = OutMaintMachine::find($id);
        $type->name = $request->name;
        $type->active = $request->active;
        $type->note = $request->note;
        $type->save();
        return redirect()->back()->with('thongbao','Edit thành công');
    }
    
}
