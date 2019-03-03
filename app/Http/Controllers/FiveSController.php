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


class FiveSController extends Controller
{
    //admin - cau hoi
    public function getListCauHoi_Admin()
    {
        $question = Question::all();        
        return view('admin.fives.question.list',compact('question'));
    }
    
    public function getAddCauHoi_Admin()
    {
        $question_group = QuestionGroup::all();
        return view('admin.fives.question.add',compact('question_group'));
    }

    public function postAddCauHoi_Admin(Request $request)
    {
        $this->validate($request,[
            'noidung'=>'required',
            'chitieu'=>'required',  
        ],
        [
            'noidung.required'=>'* Bạn chưa nhập nội dung',
            'chitieu.required'=>'* Bạn chưa nhập chỉ tiêu',
        ]);

        $question = new Question;
        $question->stt = $request->stt;
        $question->noidung = $request->noidung;
        $question->chitieu = $request->chitieu;
        $question->group_id = $request->group_id;

        $question->save();

        return redirect()->back()->with('thongbao','Đã thêm thành công');
    }

    public function getEdit_Admin($id)
    {
        $question = Question::find($id);
        $question_group = QuestionGroup::all();
        return view('admin.fives.question.edit',compact('question','question_group'));
    }

    public function postEdit_Admin($id, Request $request)
    {
        $this->validate($request,[
            'noidung'=>'required',
            'chitieu'=>'required',  
        ],
        [
            'noidung.required'=>'* Bạn chưa nhập nội dung',
            'chitieu.required'=>'* Bạn chưa nhập chỉ tiêu',
        ]);

        $question = Question::find($id);
        $question->stt = $request->stt;
        $question->noidung = $request->noidung;
        $question->chitieu = $request->chitieu;
        $question->group_id = $request->group_id;

        $question->save();

        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }
    
    public function getDelete_Admin($id)
    {
        $question = Question::find($id);
        $question->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');;
    }
    
    // admin - Question group 
    public function getList_Group_CauHoi_Admin()
    {
        $question_group = QuestionGroup::all();        
        return view('admin.fives.question-group.list',compact('question_group'));
    }

    public function getAdd_Group_CauHoi_Admin()
    {
        return view('admin.fives.question-group.add');
    }

    public function postAdd_Group_CauHoi_Admin(Request $request)
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

    public function getEdit_Group_CauHoi_Admin($id)
    {
        $question_group = QuestionGroup::find($id);
        return view('admin.fives.question-group.edit',compact('question_group'));
    }

    public function postEdit_Group_CauHoi_Admin($id, Request $request)
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

    public function getEdit_Group_Nhanvien_Admin($id)
    {
        $nhanvien_group = NhanvienGroup::find($id);
        return view('admin.fives.nhanvien-group.edit',compact('nhanvien_group'));
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
    //-admin nhan vien
    public function getList_Nhanvien_Admin()
    {
        $nhanvien = Nhanvien::all();        
        return view('admin.fives.nhanvien.list',compact('nhanvien'));
    }
    
    public function getAdd_Nhanvien_Admin()
    {
        $nhanvien_group = NhanvienGroup::all();
        return view('admin.fives.nhanvien.add',compact('nhanvien_group'));
    }

    public function postAdd_Nhanvien_Admin(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'name.required'=>'* Bạn chưa nhập nội dung',
        ]);

        $nhanvien = new Nhanvien;
        $nhanvien->name = $request->name;
        $nhanvien->phone = $request->phone;
        $nhanvien->group_id = $request->group_id;
        $nhanvien->save();

        return redirect()->back()->with('thongbao','Đã thêm thành công');
    }

    public function getEdit_Nhanvien_Admin($id)
    {
        $nhanvien = Nhanvien::find($id);
        $nhanvien_group = NhanvienGroup::all();
        return view('admin.fives.nhanvien.edit',compact('nhanvien','nhanvien_group'));
    }

    public function postEdit_Nhanvien_Admin($id, Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'noidung.required'=>'* Bạn chưa nhập nội dung',
        ]);

        $nhanvien = Nhanvien::find($id);

        $nhanvien->name = $request->name;
        $nhanvien->phone = $request->phone;
        $nhanvien->group_id = $request->group_id;
        $nhanvien->save();

        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    public function getDelete_Nhanvien_Admin($id)
    {
        $nhanvien = Nhanvien::find($id);
        $nhanvien->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');;
    }

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
                    ->cc('Linh.Tran@bluescope.com')
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
        $now_year = $now->year;
        //$dt = $now->subHours($begin);

        $soThang =  $now->diffInMonths($begin);
        $data = [];
        $data1 = [];
        $data2 = []; 
        for ($i=1; $i <= $soThang; $i++) { 
            $monthNew = $begin->addMonth()->month;

            $start = Carbon::create(2018, 8, 01, 1, 1, 0)->startOfDay()->toDateTimeString();
            $end   = Carbon::create($begin->year, $monthNew, 01, 1, 1, 0)->endOfMonth()->toDateTimeString();

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

    public function getEdit_Campaign($id)
    {
        $campaign = Campaign::find($id);
        return view('pages.5S.evaluate.campaign.edit',compact('campaign'));
    }

    public function postEdit_Campaign($id, Request $request)
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

    public function getDelete_Campaign($id)
    {
        $campaign = Campaign::find($id);
        $campaign->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');;
    }

    //***************************************************************************
    // Main - Chấm điểm
    //***************************************************************************
    
    public function getList_Main($id)
    {
        $campaign = Campaign::find($id);
        $chamdiem = Chamdiem::where('campaign_id',$id)->get();        
        return view('pages.5S.evaluate.main.list',compact('chamdiem','campaign'));
    }
    
    public function getAdd_Main($id)
    {
        $campaign = Campaign::find($id);
        $nhanvien_group = NhanvienGroup::all();
        $question_group = QuestionGroup::all();
        return view('pages.5S.evaluate.main.add',compact('campaign','nhanvien_group','question_group'));
    }

    public function postAdd_Main($id, Request $request)
    {
        $this->validate($request,[
            'nhanvien_group_id'=>'required',
        ],
        [
            'nhanvien_group_id.required'=>'* Bạn chưa chọn nhóm đánh giá',
        ]);

        $chamdiem = new Chamdiem;
        $chamdiem->nhanvien_group_id = $request->nhanvien_group_id;
        $chamdiem->question_group_id = $request->question_group_id;
        $chamdiem->campaign_id = $id;
        $chamdiem->khuvucdanhgia = $request->khuvucdanhgia;
        $chamdiem->truongnhomdanhgia = $request->truongnhomdanhgia;
        $chamdiem->ngaydanhgia = $request->ngaydanhgia;
        $chamdiem->save();
        $mangDiem[1] = $request->diem1;
        $mangDiem[2] = $request->diem2;
        $mangDiem[3] = $request->diem3;
        $mangDiem[4] = $request->diem4; 
        $mangDiem[5] = $request->diem5;
        $mangDiem[6] = $request->diem6;
        $mangNX[1] = $request->nhanxet1;
        $mangNX[2] = $request->nhanxet2;
        $mangNX[3] = $request->nhanxet3;
        $mangNX[4] = $request->nhanxet4;
        $mangNX[5] = $request->nhanxet5;
        $mangNX[6] = $request->nhanxet6;

        $question = Question::where('group_id',$request->question_group_id)
                    ->orderBy('stt')
                    ->get();
        foreach ($question as $key => $val) {
            $chitiet = new Chitiet;
            $chitiet->chamdiem_id = $chamdiem->id;
            $chitiet->cauhoi_id = $val->id;
            $chitiet->diem = $mangDiem[$key+1];
            $chitiet->nhanxet = $mangNX[$key+1];
            $chitiet->save();
        }
        return redirect()->back()->with('thongbao','Đã thêm thành công');
    }

    public function getEdit_Main($id)
    {
        $chamdiem = Chamdiem::find($id);
        $chitiet = Chitiet::where('chamdiem_id', $id)->get();
        return view('pages.5S.evaluate.main.edit',compact('chamdiem','chitiet'));
    }

    public function postEdit_Main($id, Request $request)
    {
        $this->validate($request,[
            'nhanvien_group_id'=>'required',
        ],
        [
            'nhanvien_group_id.required'=>'* Bạn chưa chọn nhóm đánh giá',
        ]);

        $chamdiem = Chamdiem::find($id);
        $chamdiem->nhanvien_group_id = $request->nhanvien_group_id;
        $chamdiem->question_group_id = $request->question_group_id;

        $chamdiem->khuvucdanhgia = $request->khuvucdanhgia;
        $chamdiem->truongnhomdanhgia = $request->truongnhomdanhgia;
        $chamdiem->ngaydanhgia = $request->ngaydanhgia;
        $chamdiem->save();

        $mangDiem[1] = $request->diem1;
        $mangDiem[2] = $request->diem2;
        $mangDiem[3] = $request->diem3;
        $mangDiem[4] = $request->diem4; 
        $mangDiem[5] = $request->diem5;
        $mangDiem[6] = $request->diem6;
        $mangNX[1] = $request->nhanxet1;
        $mangNX[2] = $request->nhanxet2;
        $mangNX[3] = $request->nhanxet3;
        $mangNX[4] = $request->nhanxet4;
        $mangNX[5] = $request->nhanxet5;
        $mangNX[6] = $request->nhanxet6;
        
        $question = Question::where('group_id',$request->question_group_id)
                    ->orderBy('stt')
                    ->get();
        foreach ($question as $key => $val) {
            $chitiet = Chitiet::where('chamdiem_id',$id)
                        ->where('cauhoi_id', $val->id)
                        ->first();
            $chitiet->chamdiem_id = $chamdiem->id;
            $chitiet->cauhoi_id = $val->id;
            $chitiet->diem = $mangDiem[$key+1];
            $chitiet->nhanxet = $mangNX[$key+1];
            $chitiet->save();
        }
        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    public function getDelete_Main($id)
    {
        $chamdiem = Chamdiem::find($id);
        $chitiet = Chitiet::where('chamdiem_id', $id)->get()->each->delete();
        $chamdiem->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');;
    }

    public function getQuestion_Main($id)
    {
        $question = Question::where('group_id',$id)->orderBy('stt')->get();
        

        echo 

        '<table class="table color-table info-table">
            <thead>
                <tr align="center">
                    <th>STT</th>
                    <th>Nội dung</th>
                    <th>Tóm tắt</th>
                    <th class="diem">Điểm</th>
                    <th class="nhanxet">Nhận xét</th>
                    
                </tr>
            </thead>
            <tbody>';

                foreach($question as $val) {
                    echo '<tr>
                        <td>'.$val->stt.'</td>
                        <td>'.$val->noidung.'</td>
                        <td>'.$val->chitieu.'</td>
                        <td>'.
                            '<div class="form-group">
                                <input class="form-control" type="text" name="diem'.$val->stt.'">
                            </div>'



                        .'</td>
                        <td>'.

                            '<div class="col-lg-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="nhanxet'.$val->stt.'">
                                </div>
                            </div>'

                        .'</td>
                    </tr>';
                }                   
            echo'</tbody>   
        </table>';
    }


    //Pages Group Nhan Vien
    public function getList_Group_Nhanvien()
    {
        $nhanvien_group = NhanvienGroup::all();        
        return view('pages.5S.evaluate.nhanvien-group.list',compact('nhanvien_group'));
    }

    public function getAdd_Group_Nhanvien()
    {
        return view('pages.5S.evaluate.nhanvien-group.add');
    }

    public function postAdd_Group_Nhanvien(Request $request)
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

    public function getEdit_Group_Nhanvien($id)
    {
        $nhanvien_group = NhanvienGroup::find($id);
        return view('pages.5S.evaluate.nhanvien-group.edit',compact('nhanvien_group'));
    }

    public function postEdit_Group_Nhanvien($id, Request $request)
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

    public function getDelete_Group_Nhanvien($id)
    {
        $nhanvien_group = NhanvienGroup::find($id);
        $nhanvien_group->delete();

        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }

    //---------------------------------------------------------
    //-Pages nhan vien
    public function getList_Nhanvien()
    {
        $nhanvien = Nhanvien::all();        
        return view('pages.5S.evaluate.nhanvien.list',compact('nhanvien'));
    }
    
    public function getAdd_Nhanvien()
    {
        $nhanvien_group = NhanvienGroup::all();
        return view('pages.5S.evaluate.nhanvien.add',compact('nhanvien_group'));
    }

    public function postAdd_Nhanvien(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'name.required'=>'* Bạn chưa nhập nội dung',
        ]);

        $nhanvien = new Nhanvien;
        $nhanvien->name = $request->name;
        $nhanvien->phone = $request->phone;
        $nhanvien->group_id = $request->group_id;
        $nhanvien->save();

        return redirect()->back()->with('thongbao','Đã thêm thành công');
    }

    public function getEdit_Nhanvien($id)
    {
        $nhanvien = Nhanvien::find($id);
        $nhanvien_group = NhanvienGroup::all();
        return view('pages.5S.evaluate.nhanvien.edit',compact('nhanvien','nhanvien_group'));
    }

    public function postEdit_Nhanvien($id, Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'noidung.required'=>'* Bạn chưa nhập nội dung',
        ]);

        $nhanvien = Nhanvien::find($id);

        $nhanvien->name = $request->name;
        $nhanvien->phone = $request->phone;
        $nhanvien->group_id = $request->group_id;
        $nhanvien->save();

        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    public function getDelete_Nhanvien($id)
    {
        $nhanvien = Nhanvien::find($id);
        $nhanvien->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');;
    }

    //---------------------------------------------------------
}
