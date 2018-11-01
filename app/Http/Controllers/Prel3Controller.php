<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\MaintenanceIndex;
use App\MaintenanceMachine;
use App\Workcenter;

class Prel3Controller extends Controller
{

    public function getDanhSachWCAdmin()
    {
        $workcenter = Workcenter::all();
        return view('admin.prel3.danhsachworkcenter',compact('workcenter'));
    }

    public function getThemWC()
    {
        return view('admin.prel3.themworkcenter');
    }
    
    public function postThemWC(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên workcenter',
        ]);

        $workcenter = new Workcenter;
        $workcenter->name = $request->name;
        $workcenter->save();
        return redirect('admin/prel3/themwc')->with('thongbao','Thêm thành công');
    }

    public function getSuaWC($id)
    {
        $workcenter = Workcenter::find($id);
        return view('admin.prel3.suaworkcenter',compact('workcenter'));
    }
    
    public function postSuaWC(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required'
        ],
        [
            'name.required'=>'Bạn chưa nhập tên workcenter'
        ]);

        $workcenter = Workcenter::find($id);
        $workcenter->name = $request->name;
        $workcenter->save();
        return redirect('admin/prel3/suawc/'.$id)->with('thongbao','Sửa thành công');
    }
}
