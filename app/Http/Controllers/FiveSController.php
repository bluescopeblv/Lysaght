<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LoaiKhiemKhuyet;
use App\DefectList;
use Mail;
use App\Workcenter;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Charts\SampleChart;

class FiveSController extends Controller
{
	public function get5S()
    {
        $loaikhiemkhuyet = LoaiKhiemKhuyet::all();
        $arrName = array();
        $arrTong = array();
        $arrDaGiaiQuyet = array();
        $workcenter = Workcenter::all();
        foreach ($workcenter as $wc) {
        	$tong = count(DefectList::where('workcenter',"$wc->name")->get());
        	$tongDaGiaiQuyet = count(DefectList::where('workcenter',"$wc->name")->where('status',1)->get());
        	//echo "string ".$wc->name;
        	array_push($arrName, "$wc->name");
        	array_push($arrTong, "$tong");
        	array_push($arrDaGiaiQuyet, "$tongDaGiaiQuyet");
        }
        $arrAll = array(
        		'name' => $arrName,
        		'tong' => $arrTong,
        		'dagiaiquyet' => $arrDaGiaiQuyet,
        		'sum' => count($workcenter),
        	);
        //var_dump($arrAll);

        if(Auth::user()){
            if(Auth::user()->quyen_5s >= 2)
                $defect = DefectList::all();
            else
            {
                $defect = DefectList::where('workcenter',Auth::user()->workcenter)->paginate(10);
            }
            return view('pages.5S.5S',compact('loaikhiemkhuyet','defect','arrAll'));
        }
        else{
            return view('pages.5S.5S',compact('loaikhiemkhuyet','arrAll'));
        }
    }

    public function post5S(Request $request)
    {
        $this->validate($request,[
            'workcenter'=>'required',
            'mota'=>'required',  
            'loaikhiemkhuyet'=>'required' 
        ],
        [
            'workcenter.required'=>'* Bạn chưa nhập workcenter',
            'mota.required'=>'* Bạn chưa nhập khiếm khuyết',
            'loaikhiemkhuyet.required'=>'* Bạn chưa chọn loại khiếm khuyết',
        ]);

        $defectlist = new DefectList;
        
        $defectlist->workcenter = $request->workcenter;
        $defectlist->date = date('Y-m-d');
        $defectlist->mota = $request->mota;
        $defectlist->theso = $request->sothe;
        $defectlist->id_loaikhiemkhuyet = $request->loaikhiemkhuyet;
        $defectlist->laplai = $request->laplai;
        $defectlist->save();

        //------------------------------------------------------------------
        //Gửi mail
        $data['title'] = "5S - DANH SÁCH KHIẾM KHUYẾT";
        $data['workcenter'] = $request->workcenter;
        $data['ngay'] = date('d-M-Y');
        $data['name'] = Auth::user()->name;
        $data['sdt'] = Auth::user()->sdt;
        $data['mota'] = $request->mota;
        $data['theso'] = $request->sothe;

        $subject = '5S- RECORD KHIẾM KHUYẾT - WC '.$request->workcenter;

        Mail::send('emails.email_5s', $data, function($message) use ($subject) {
            $message->from('l3lysaght.svr01@gmail.com', 'Pre-L3 Project');
            $message->to('Tran.Thuc@bluescope.com')
                    ->cc('hue.bui@bluescope.com')
                    ->cc('sanh.nguyen@bluescope.com')
                    ->cc('Duc.Nguyen2@bluescope.com')
                    ->cc('Tu.Truong@bluescope.com')
                    ->cc('phuc.truong@bluescope.com')
                    ->subject($subject);
            // $message->to('phuc.truong@bluescope.com')
            //         ->subject($subject);
        });
        //------------------------------------------------------------------
        return redirect()->back()->with('thongbao1',"Bạn đã gửi thành công");
    }

    public function get5Schitiet($id)
    {
        $detail = DefectList::find($id);
        return view('pages.5S.5Schitiet',compact('detail'));
    }

    public function post5Schitiet(Request $request,$id)
    {
        $this->validate($request,[
            'ppkhacphuc'=>'required',
            'nguoichiutrachnhiem'=>'required',  
            'status'=>'required' 
        ],
        [
            'ppkhacphuc.required'=>'* Bạn chưa nhập phương pháp khắc phục',
            'nguoichiutrachnhiem.required'=>'* Bạn chưa nhập người thực hiện',
            'status.required'=>'* Bạn chưa chọn tình trạng hoàn thành',
        ]);

        $defectlist = DefectList::find($id);
        
        $defectlist->ppkhacphuc = $request->ppkhacphuc;
        $defectlist->ngayhoanthanh = date('Y-m-d');
        $defectlist->nguoichiutrachnhiem = $request->nguoichiutrachnhiem;
        $defectlist->status = $request->status;
        $defectlist->notes = $request->notes;
        
        $defectlist->save();

        return redirect()->back()->with('thongbao1',"Bạn đã gửi thành công");
    }

    public function getThongKe5S()
    {
        $begin = Carbon::create(2018, 7, 01, 0, 0, 0);

        $now  = Carbon::now();
        $now_month = $now->month;
        //$dt = $now->subHours($begin);

        $soThang =  $now->diffInMonths($begin);
        $data = [];
        $data1 = [];
        $data2 = []; 
        for ($i=1; $i <= $soThang; $i++) { 
            $monthNew = $begin->addMonth()->month;

            $start = Carbon::create(2018, 8, 01, 1, 1, 0)->startOfDay()->toDateTimeString();
            $end   = Carbon::create(2018, $monthNew, 01, 1, 1, 0)->endOfMonth()->toDateTimeString();

            $defect = count(DefectList::where('date','>=', $start)->where('date','<',$end)->get());
            $complete = count(DefectList::where('ngayhoanthanh','>=', $start)->where('ngayhoanthanh','<',$end)
                        ->where('status',1)->get());

            array_push($data, "Tháng ".$begin->month);
            array_push($data1, $defect);
            array_push($data2, $complete);
        }
        
        $chart = new SampleChart;
        $chart->labels($data);
        $chart->dataset('Defect', 'line', $data1)->color('blue');
        $chart->dataset('Xử lí', 'line', $data2)->color('green');
        //$chart->options(['color' => ['green']]);

        // $chart->dataset('datasheet2', 'line', [4,7,1,1]);

        return view('pages.5S.thongke.list', compact('chart'));


    }
    
}
