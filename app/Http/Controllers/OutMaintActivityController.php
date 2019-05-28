<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\OutMaintType;
use App\OutMaintMachine;
use App\OutMaintActivity;
use Carbon\Carbon;

class OutMaintActivityController extends Controller
{

    public function getList()
    {
    	$maintenances = OutMaintActivity::all();
    	return view('v2.member.outmaint.activity.list',compact('maintenances'));
    }

    public function getAdd()
    {
    	$machines = OutMaintMachine::all();
    	$types = OutMaintType::all();
    	return view('v2.member.outmaint.activity.add',compact('machines','types'));
    }

    public function postAdd(Request $request)
    {
    	$this->validate($request,[
            'outs_maint_type_id' => 'required',
            'outs_maint_machine_id'=>'required',
            'date' => 'required',
            'content'=>'required',
        ],
        [
            'outs_maint_type_id.required'=>'Bạn chưa chọn loại bảo trì',
            'outs_maint_machine_id.required'=>'Bạn chưa chọn máy',
            'date.required'=>'Bạn chưa nhập ngày',
            'content.required'=>'Bạn chưa nhập nội dung'
        ]);

        $activity = new OutMaintActivity;
        $activity->outs_maint_type_id = $request->outs_maint_type_id;
        $activity->outs_maint_machine_id = $request->outs_maint_machine_id;
        $activity->user_id = Auth::user()->id;
        $activity->date = $request->date;
        $activity->content = $request->content;
        $activity->solution_date = $request->solution_date;
        $activity->solution = $request->solution;
        $activity->note = $request->note;

        $activity->save();
        return redirect()->back()->with('thongbao','Thêm thành công');
    }

    public function getEdit($id)
    {
    	$machines = OutMaintMachine::all();
    	$types = OutMaintType::all();

    	$activity = OutMaintActivity::find($id);
    	return view('v2.member.outmaint.activity.edit',compact('machines','types', 'activity'));
    }
    
    public function postEdit($id, Request $request)
    {
    	$this->validate($request,[
            'outs_maint_type_id' => 'required',
            'outs_maint_machine_id'=>'required',
            'date' => 'required',
            'content'=>'required',
        ],
        [
            'outs_maint_type_id.required'=>'Bạn chưa chọn loại bảo trì',
            'outs_maint_machine_id.required'=>'Bạn chưa chọn máy',
            'date.required'=>'Bạn chưa nhập ngày',
            'content.required'=>'Bạn chưa nhập nội dung'
        ]);

        $activity =  OutMaintActivity::find($id);
        $activity->outs_maint_type_id = $request->outs_maint_type_id;
        $activity->outs_maint_machine_id = $request->outs_maint_machine_id;
        $activity->user_id = Auth::user()->id;
        $activity->date = $request->date;
        $activity->content = $request->content;
        $activity->solution_date = $request->solution_date;
        $activity->solution = $request->solution;
        $activity->note = $request->note;

        $activity->save();
        return redirect()->back()->with('thongbao','Thêm thành công');
    }

    public function getExportExcel1()
    {
        $today = Carbon::now();
        $ngay =  Carbon::create(Carbon::now()->year, Carbon::now()->month, Carbon::now()->day, 0, 0, 0);
        $ngay2 = Carbon::create(Carbon::now()->year, Carbon::now()->month, Carbon::now()->day, 23, 59, 59);
         
        $activitys = OutMaintActivity::where('created_at','>=',"$ngay")
                    ->where('created_at','<=',"$ngay2")
                    ->orderBy('created_at')
                    ->get();
        return view('v2.member.outmaint.report.export',compact('activitys', 'today','ngay','ngay2'));
    }

    public function postExportExcel1(Request $request){
        $type = "xlsx";
        $today = Carbon::now();
        $ngay = $request->DateFind;
        $ngay2 = $request->DateFind2;
        $ngay =  Carbon::create(substr($ngay, 0, 4), substr($ngay, 5, 2), substr($ngay, 8, 2), 0, 0, 0);
        $ngay2 = Carbon::create(substr($ngay2, 0, 4), substr($ngay2, 5, 2), substr($ngay2, 8, 2), 23, 59, 59);
        

        $activities = OutMaintActivity::where('created_at','>=',"$ngay")
                    ->where('created_at','<=',"$ngay2")
                    ->orderBy('created_at')
                    ->get();

        $duoi1 = date('Ymd');
        $duoi2 = date('His');

        \Excel::create('MAINT - OUTSOURCE - '.$duoi1.' - '.$duoi2, function($excel) use($activities, $today, $ngay, $ngay2){

            $excel->sheet('New sheet', function($sheet) use($activities, $today,$ngay, $ngay2){

                $sheet->loadView('v2.member.outmaint.report.excel')
                      ->with('activities', $activities,
                             'today', $today,
                             'ngay', $ngay,
                             'ngay2', $ngay2);
                      
                //         // Set background color for a specific cell
                // $sheet->getStyle('AG2:AL500')->applyFromArray(array(
                //     'fill' => array(
                //         'color' => array('rgb' => '00ff00')
                //     )
                // ));

            });
        })->download($type);

        // \Excel::create('PREL3 - Delivery - '.$duoi1.' - '.$duoi2, function($excel) use ($data) {
        //     $excel->sheet('Sheet 1', function($sheet) use ($data)
        //     {
        //         $sheet->fromArray($data, null, 'A1', false, false);
        //     });
        // })->download($type);

        return redirect()->back();
    } 
}
