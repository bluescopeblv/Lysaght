<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DeliveryThongTinXe;
use App\DeliveryDetail;
use App\DeliveryPicture;
use App\KPI;
use DB;
use Mail;
use Illuminate\Support\Facades\Storage;


class KPIController extends Controller
{
    //admin


    //member
    //member - qc
    public function getList_QC()
    {
    	$KPIs = KPI::all();
    	return view('v2.member.kpi.qc.list',compact('KPIs'));
    }

    public function getEdit_QC($id)
    {
        $KPI = KPI::find($id);
        return view('v2.member.kpi.qc.edit',compact('KPI'));
    }

    public function postEdit_QC(Request $request,$id)
    {
        // $this->validate($request,[
        //     'supplier_name' => 'required',
        //     'sokien'=>'required',
        // ],
        // [
        //     'supplier_name.required'=>'Bạn chưa nhập tên khách hàng',
        //     'sokien.required'=>'Bạn chưa nhập số kiện'
        // ]);

        $KPI = KPI::find($id);
        $KPI->QC_DEFECT_NUMBER = $request->QC_DEFECT_NUMBER;
        $KPI->QC_AMOUNT_OF_CODE = $request->QC_AMOUNT_OF_CODE;
        $KPI->QC_COD_PER = $request->QC_COD_PER;
        $KPI->QC_PERCENT_INHOUSE = $request->QC_PERCENT_INHOUSE;
        $KPI->QC_PERCENT_OUTSCOURCE = $request->QC_PERCENT_OUTSCOURCE;
        $KPI->QC_RATIO_PROACTIVE = $request->QC_RATIO_PROACTIVE;

        $KPI->save();
        return redirect()->back()->with('thongbao','Cập nhật thành công');
    }

    public function getList_MAIN()
    {
        $KPIs = KPI::all();
        return view('v2.member.kpi.maintenance.list',compact('KPIs'));
    }
    
    public function getEdit_MAIN($id)
    {
        $KPI = KPI::find($id);
        return view('v2.member.kpi.maintenance.edit',compact('KPI'));
    }

    public function postEdit_MAIN(Request $request,$id)
    {
        // $this->validate($request,[
        //     'supplier_name' => 'required',
        //     'sokien'=>'required',
        // ],
        // [
        //     'supplier_name.required'=>'Bạn chưa nhập tên khách hàng',
        //     'sokien.required'=>'Bạn chưa nhập số kiện'
        // ]);

        $KPI = KPI::find($id);
        $KPI->MAI_BREAK_NUMBER = $request->MAI_BREAK_NUMBER;
        $KPI->MAI_BREAK_LEADTIME = $request->MAI_BREAK_LEADTIME;
        $KPI->MAI_PERCEN_PREVENTIVE = $request->MAI_PERCEN_PREVENTIVE;
        $KPI->MAI_COST = $request->MAI_COST;

        $KPI->save();
        return redirect()->back()->with('thongbao','Cập nhật thành công');
    }

    public function getList_OUT()
    {
        $KPIs = KPI::all();
        return view('v2.member.kpi.outsource.list',compact('KPIs'));
    }
    
    public function getEdit_OUT($id)
    {
        $KPI = KPI::find($id);
        return view('v2.member.kpi.outsource.edit',compact('KPI'));
    }

    public function postEdit_OUT(Request $request,$id)
    {
        // $this->validate($request,[
        //     'supplier_name' => 'required',
        //     'sokien'=>'required',
        // ],
        // [
        //     'supplier_name.required'=>'Bạn chưa nhập tên khách hàng',
        //     'sokien.required'=>'Bạn chưa nhập số kiện'
        // ]);

        $KPI = KPI::find($id);
        $KPI->OUT_INBOUND_TRUCK = $request->OUT_INBOUND_TRUCK;
        $KPI->OUT_LOGICTIS_COST = $request->OUT_LOGICTIS_COST;
        $KPI->OUT_COST = $request->OUT_COST;
        $KPI->OUT_ROS = $request->OUT_ROS;
        $KPI->OUT_ROS_COST = $request->OUT_ROS_COST;

        $KPI->save();
        return redirect()->back()->with('thongbao','Cập nhật thành công');
    }

    //Safety
    public function getList_SAF()
    {
        $KPIs = KPI::all();
        return view('v2.member.kpi.safety.list',compact('KPIs'));
    }
    
    public function getEdit_SAF($id)
    {
        $KPI = KPI::find($id);
        return view('v2.member.kpi.safety.edit',compact('KPI'));
    }

    public function postEdit_SAF(Request $request,$id)
    {
        // $this->validate($request,[
        //     'supplier_name' => 'required',
        //     'sokien'=>'required',
        // ],
        // [
        //     'supplier_name.required'=>'Bạn chưa nhập tên khách hàng',
        //     'sokien.required'=>'Bạn chưa nhập số kiện'
        // ]);

        $KPI = KPI::find($id);
        $KPI->SAF_SAO_AUDIT = $request->SAF_SAO_AUDIT;
        $KPI->SAF_TIRED_SAO = $request->SAF_TIRED_SAO;
        $KPI->SAF_QUALITY_CHECK = $request->SAF_QUALITY_CHECK;
        
        $KPI->save();
        return redirect()->back()->with('thongbao','Cập nhật thành công');
    }

    //Production
    public function getList_PROD()
    {
        $KPIs = KPI::all();
        return view('v2.member.kpi.production.list',compact('KPIs'));
    }
    
    public function getEdit_PROD($id)
    {
        $KPI = KPI::find($id);
        return view('v2.member.kpi.production.edit',compact('KPI'));
    }

    public function postEdit_PROD(Request $request,$id)
    {
        // $this->validate($request,[
        //     'supplier_name' => 'required',
        //     'sokien'=>'required',
        // ],
        // [
        //     'supplier_name.required'=>'Bạn chưa nhập tên khách hàng',
        //     'sokien.required'=>'Bạn chưa nhập số kiện'
        // ]);

        $KPI = KPI::find($id);
        $KPI->MFG_VOLUME = $request->MFG_VOLUME;
        $KPI->MFG_OEE = $request->MFG_OEE;
        $KPI->MFG_UPTIME = $request->MFG_UPTIME;
        $KPI->MFG_LOADINGTIME = $request->MFG_LOADINGTIME;
        $KPI->OUT_ROS_COST = $request->OUT_ROS_COST;

        $KPI->save();
        return redirect()->back()->with('thongbao','Cập nhật thành công');
    }

    //-----------------------
    public function import_thongtinxe(Request $request){

        if($request->hasFile('sample_file')){
            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            //var_dump($data);

            // foreach ($data as $key => $value) {
            // 	echo "key: ".$key. "-  value: ".$value->co;
            // 	echo " <br> ";
            // }
            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = [
                    	'CO' => $value->co,
                        'supplier_name' => $value->supplier_name,
                        'sokien' => $value->sokien,
                        'khoiluong' => $value->khoiluong,
                        'sanpham' => $value->sanpham,
                        'tentaixe' => $value->tentaixe,
                        'bienso' => $value->bienso,
                        'nhaxe' => $value->nhaxe,
                        'soluongxe' => $value->soluongxe,
                        'note' => $value->note,
                        'updated_at' => date('Y-m-d h:m:s'),
                        'created_at' => date('Y-m-d h:m:s'),
                        ];
                }
                if(!empty($arr)){
                    DB::table('delivery_thongtinxe')->insert($arr);
                    //dd('Insert Recorded successfully.');
                    return redirect()->back()->with('thongbao','Import thành công');

                }
            }
        }      
    }

    public function export_thongtinxe($type)
    {
    	$thongtinxe = DeliveryThongTinXe::get()->toArray();
    	//var_dump($thongtinxe);

        return \Excel::create('Sample', function($excel) use ($thongtinxe) {
            $excel->sheet('Sheet 1', function($sheet) use ($thongtinxe)
            {
                $sheet->fromArray($thongtinxe);

            });
        })->download($type);
    }

    




       

     
    
}
