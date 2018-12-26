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
use App\Question;
use App\QuestionGroup;
use App\Nhanvien;
use App\NhanvienGroup;
use App\Campaign;
use App\Chamdiem;
use App\Chitiet;
use App\Charts\Charts;


class FiveSReportController extends Controller
{
    //admin - cau hoi

    public function postAdd_Group_CauHoi_Admin1(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'name.required'=>'* Bạn chưa nhập tên',
        ]);

        $question_group = new QuestionGroup;
        $question_group->name = $request->name;
        $question_group->note = $request->note;
        $question_group->save();

        $question_group = QuestionGroup::all();
        return view('admin.fives.question-group.list',compact('question_group'))->with('thongbao','Đã thêm thành công');
    }

    public function getEdit_Group_CauHoi_Admin1($id)
    {
        $question_group = QuestionGroup::find($id);
        return view('admin.fives.question-group.edit',compact('question_group'));
    }

    public function postEdit_Group_CauHoi_Admin1($id, Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'name.required'=>'* Bạn chưa nhập tên',
        ]);

        $question_group = QuestionGroup::find($id);
        $question_group->name = $request->name;
        $question_group->note = $request->note;
        $question_group->save();

        $question_group = QuestionGroup::all();
        return view('admin.fives.question-group.list',compact('question_group'))->with('thongbao','Đã sửa thành công');
    }

    public function getDelete_Group_CauHoi_Admin($id)
    {
        $question_group = QuestionGroup::find($id);
        $question_group->delete();

        $question_group = QuestionGroup::all();
        return view('admin.fives.question-group.list',compact('question_group'));
    }

    // admin - group - nhan vien
    public function getList_Group_Nhanvien_Admin()
    {
        $nhanvien_group = NhanvienGroup::all();        
        return view('admin.fives.nhanvien-group.list',compact('nhanvien_group'));
    }

    public function getAdd_Group_Nhanvien_Admin()
    {
        return view('admin.fives.nhanvien-group.add');
    }

    public function postAdd_Group_Nhanvien_Admin(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'name.required'=>'* Bạn chưa nhập tên',
        ]);

        $nhanvien_group = new NhanvienGroup;
        $nhanvien_group->name = $request->name;
        $nhanvien_group->note = $request->note;
        $nhanvien_group->save();

        return redirect()->back()->with('thongbao','Đã thêm thành công');
    }

    

    public function postEdit_Group_Nhanvien_Admin($id, Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'name.required'=>'* Bạn chưa nhập tên',
        ]);

        $nhanvien_group = NhanvienGroup::find($id);
        $nhanvien_group->name = $request->name;
        $nhanvien_group->note = $request->note;
        $nhanvien_group->save();

        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    public function getDelete_Group_Nhanvien_Admin($id)
    {
        $nhanvien_group = NhanvienGroup::find($id);
        $nhanvien_group->delete();

        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }

    //---------------------------------------------------------

    //---------------------------------------------------------
    //-admin campaign
    public function getList_Campaign_Admin()
    {
        $campaign = Campaign::all();        
        return view('admin.fives.campaign.list',compact('campaign'));
    }
    
    public function getAdd_Campaign_Admin()
    {
        return view('admin.fives.campaign.add');
    }

    public function postAdd_Campaign_Admin(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'name.required'=>'* Bạn chưa nhập nội dung',
        ]);

        $campaign = new Campaign;
        $campaign->name = $request->name;
        $campaign->note = $request->note;
        $campaign->save();

        return redirect()->back()->with('thongbao','Đã thêm thành công');
    }

    public function getEdit_Campaign_Admin($id)
    {
        $campaign = Campaign::find($id);
        return view('admin.fives.campaign.edit',compact('campaign'));
    }

    public function postEdit_Campaign_Admin($id, Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'noidung.required'=>'* Bạn chưa nhập nội dung',
        ]);

        $campaign = Campaign::find($id);
        $campaign->name = $request->name;
        $campaign->note = $request->note;
        $campaign->save();
        
        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    public function getDelete_Campaign_Admin($id)
    {
        $campaign = Campaign::find($id);
        $campaign->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');;
    }


    

    //----------------------------------------------------------------
    //pages
    //----------------------------------------------------------------
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

    
    
    public function getExportExcel()
    {
        return view('pages.5S.export.excel');
    }

    public function get5sList($type){
        $lists = DefectList::join('loaikhiemkhuyet','id_loaikhiemkhuyet','=','loaikhiemkhuyet.id')
                    ->select('workcenter','date','mota','theso','loaikhiemkhuyet.name','ppkhacphuc','status','ngayhoanthanh','nguoichiutrachnhiem')
                    ->get()
                    ->toArray();
        
        $duoi = date('YmdHms');

        return \Excel::create('5S - DANH SACH 5S - '.$duoi, function($excel) use ($lists) {
            $excel->sheet('Sheet 1', function($sheet) use ($lists)
            {
                $sheet->fromArray($lists);
            });
        })->download($type);
    }

//===========================================================================
// Function Danh gia 5s
//===========================================================================
    public function getList_AllFunction()
    {
        return view('pages.5S.evaluate.interface');
    }

    //***************************************************************************
    // Campaign
    //***************************************************************************
    
    public function getList_Campaign()
    {
        $campaign = Campaign::all();        
        return view('pages.5S.evaluate.campaign.list',compact('campaign'));
    }
    
    public function getAdd_Campaign()
    {
        return view('pages.5S.evaluate.campaign.add');
    }

    public function postAdd_Campaign(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'name.required'=>'* Bạn chưa nhập nội dung',
        ]);

        $campaign = new Campaign;
        $campaign->name = $request->name;
        $campaign->note = $request->note;
        $campaign->save();

        return redirect()->back()->with('thongbao','Đã thêm thành công');
    }

    public function ve_do_thi()
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
    

    

    //***************************************************************************
    // Main - Chấm điểm
    //***************************************************************************


    //***************************************************************************
    // Main - Report
    //***************************************************************************
    public function getList_Main_Report()
    {
        $campaign = Campaign::all();
        $chamdiem = Chamdiem::all();        
        return view('pages.5S.report.list',compact('chamdiem','campaign'));
    }
    
    public function get_chart_campaign()
    {
        $begin = Carbon::create(2018, 7, 01, 0, 0, 0);

        $now  = Carbon::now();
        $now_month = $now->month;
        //$dt = $now->subHours($begin);

        $soThang =  $now->diffInMonths($begin);
        $group = [];
        $data = [];
        $data2 = [];
        $result = [];
        $data_out = [];

        $nhanvien_group = NhanvienGroup::all();
        $campaign = Campaign::all();

        foreach ($nhanvien_group as $key1 => $val1) {
            $campaignName = [];
            foreach ($campaign as $key2 => $val2) {
                $chamdiem = Chamdiem::where('campaign_id', $val2->id)
                            ->where('nhanvien_group_id',  $val1->id)
                            ->first();
                if(isset($chamdiem)){
                    $result[$key1][$key2] = getDiem_5S_Nhom($chamdiem->id);
                }else{
                    $result[$key1][$key2] = 0;
                }

                $lastKey1 = $key1;
                $lastKey2 = $key2;
                array_push($campaignName, $val2->name);
            }
            array_push($group, $val1->name);
        }
        
        for ($i=0; $i <= $lastKey2; $i++) { 
            # Chạy bao nhóm
            for ($j=0; $j <= $lastKey1 ; $j++) { 
                //Có lastkey đợt
                array_push($data, $result[$j][$i]);
            }

            $data_out[$i] = $data;
            $data = [];
        }
        
        $chart = new SampleChart;
        $chart->labels($group);
        $color = ['blue','red','green','yellow','pink'];
        for ($i=0; $i <= $lastKey2 ; $i++) { 
            $chart->dataset($campaignName[$i],'bar',$data_out[$i])
                  ->color($color[$i])
                  ->backgroundColor($color[$i]);
        }
        $chart->options(['color' => ['green']]);
        $chart->barWidth('0.8');
        return view('pages.5S.report.chart-campaign', compact('chart'));
    }
    
    public function get_chart_group()
    {
        $begin = Carbon::create(2018, 7, 01, 0, 0, 0);

        $now  = Carbon::now();
        $now_month = $now->month;
        //$dt = $now->subHours($begin);

        $soThang =  $now->diffInMonths($begin);
        $group = [];
        $data = [];
        $data2 = [];
        $result = [];
        $data_out = [];

        $nhanvien_group = NhanvienGroup::all();
        $campaign = Campaign::all();

        foreach ($nhanvien_group as $key1 => $val1) {
            $campaignName = [];
            foreach ($campaign as $key2 => $val2) {
                $chamdiem = Chamdiem::where('campaign_id', $val2->id)
                            ->where('nhanvien_group_id',  $val1->id)
                            ->first();
                if(isset($chamdiem)){
                    $result[$key1][$key2] = getDiem_5S_Nhom($chamdiem->id);
                }else{
                    $result[$key1][$key2] = 0;
                }

                $lastKey1 = $key1;
                $lastKey2 = $key2;
                array_push($campaignName, $val2->name);
            }
            array_push($group, $val1->name);
        }
        
        for ($i=0; $i <= $lastKey1; $i++) { 
            # Chạy bao nhóm
            for ($j=0; $j <= $lastKey2 ; $j++) { 
                //Có lastkey đợt
                array_push($data, $result[$i][$j]);
            }

            $data_out[$i] = $data;
            $data = [];
        }

        //print_r($data_out);
        
        $chart = new Charts;
        $chart->labels($campaignName);
        $color = ['blue','red','green','yellow','pink','#cc00cc','#00cc00','#993300'];
        for ($i=0; $i <= $lastKey1 ; $i++) { 
            $chart->dataset($group[$i],'bar',$data_out[$i])
                  ->color($color[$i])
                  ->backgroundColor($color[$i])
                  ->fill(false);
        }
        //$chart->options(['color' => ['green']]);
        $chart->options([
            'tooltip' => [
                'show' => false // or false, depending on what you want.
            ]

        ]);
        // $title = "123";
        // $chart->title($title, $font_size = 14, $color = '#666', $bold = true, $font_family = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
        $chart->displayLegend(true);
        $chart->barWidth('0.8');

 
        return view('pages.5S.report.chart-campaign', compact('chart'));
    }

}
