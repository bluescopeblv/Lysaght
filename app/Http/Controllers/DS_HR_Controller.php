<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DS_HR;

class DS_HR_Controller extends Controller
{
    //
    public function get_List()
    {
    	$hr = DS_HR::orderBy('id','DESC')->get();
    	return view('pages.dashboard.hr.list', compact('hr'));
    }

    public function get_Add()
    {
    	return view('pages.dashboard.hr.add');
    }

    public function post_Add(Request $request)
    {
    	$this->validate($request,[
            'total_employees' => 'required',
            'female_employees'=>'required',
        ],
        [
            'total_employees.required'=>'Bạn chưa nhập tổng nhân viên',
            'female_employees.required'=>'Bạn chưa nhập số nhân viên nữ',
        ]);

        $hr = new DS_HR;
        $hr->total_employees = $request->total_employees;
        $hr->female_employees = $request->female_employees;
          
        $hr->save();
        //------------------------------------------------------------------
        //Gửi mail
        // $data['title'] = "GIAO HÀNG - THÔNG BÁO XE ĐẾN Ở CỔNG BẢO VỆ SỐ 1";
        // $data['name'] = Auth::user()->name;
        // $data['sdt'] = Auth::user()->sdt;

        // $data['khachhang'] = $request->khachhang;
        // $data['tentaixe'] = $request->tentaixe;
        // $data['bienso'] = $request->bienso;
        // $data['nhaxe'] = $request->nhaxe;
        // $data['taitrongxe'] = $request->taitrongxe;
        // $data['thoigianxevao'] = $thoigianxevao;

        // $subject = 'GIAO HÀNG - THÔNG BÁO XE ĐẾN - KH: '.$request->khachhang;

        // Mail::send('emails.delivery.dencong1', $data, function($message) use ($subject) {
        //     $message->from('l3lysaght.svr01@gmail.com', 'Delivery Project');
        //     $message->to('phuc.truong@bluescope.com')
        //             ->cc('phuc.truong@bluescope.com')
        //             ->subject($subject);
            // $message->to('phuc.truong@bluescope.com')
            //         ->subject($subject);
        //});
        //-------------------------------------------------------------------

        return redirect()->back()->with('thongbao','Thêm thành công');
    }

    public function get_Edit($id)
    {
    	$hr = DS_HR::find($id);
    	return view('pages.dashboard.hr.edit',compact('hr'));
    }

    public function post_Edit($id, Request $request)
    {
    	$this->validate($request,[
            'total_employees' => 'required',
            'female_employees'=>'required',
        ],
        [
            'total_employees.required'=>'Bạn chưa nhập tổng nhân viên',
            'female_employees.required'=>'Bạn chưa nhập số nhân viên nữ',
        ]);

        $hr = DS_HR::find($id);
        $hr->total_employees = $request->total_employees;
        $hr->female_employees = $request->female_employees;
          
        $hr->save();
        //------------------------------------------------------------------
        //Gửi mail
        // $data['title'] = "GIAO HÀNG - THÔNG BÁO XE ĐẾN Ở CỔNG BẢO VỆ SỐ 1";
        // $data['name'] = Auth::user()->name;
        // $data['sdt'] = Auth::user()->sdt;

        // $data['khachhang'] = $request->khachhang;
        // $data['tentaixe'] = $request->tentaixe;
        // $data['bienso'] = $request->bienso;
        // $data['nhaxe'] = $request->nhaxe;
        // $data['taitrongxe'] = $request->taitrongxe;
        // $data['thoigianxevao'] = $thoigianxevao;

        // $subject = 'GIAO HÀNG - THÔNG BÁO XE ĐẾN - KH: '.$request->khachhang;

        // Mail::send('emails.delivery.dencong1', $data, function($message) use ($subject) {
        //     $message->from('l3lysaght.svr01@gmail.com', 'Delivery Project');
        //     $message->to('phuc.truong@bluescope.com')
        //             ->cc('phuc.truong@bluescope.com')
        //             ->subject($subject);
            // $message->to('phuc.truong@bluescope.com')
            //         ->subject($subject);
        //});
        //-------------------------------------------------------------------

        return redirect()->back()->with('thongbao','Edit successfully');
    }

    public function get_Delete($id)
    {
    	$hr = DS_HR::find($id);
    	$hr->delete();
    	return redirect()->back()->with('thongbao','Delete successfully');
    }
}
