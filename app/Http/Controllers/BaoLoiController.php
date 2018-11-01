<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\TheLoai;
use App\TinTuc;
use App\loaiTin;
use App\Slide;
use App\User;
use App\KeHoach;
use Carbon\Carbon;
use App\ThongBao;
use App\Feedback;
use App\LoaiKhiemKhuyet;
use App\DefectList;
use App\BaoLoi;
use Mail;

class BaoLoiController extends Controller
{
	function __construct()
	{
	
	}


    function postNguoiDung(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required|min:3',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên',
            'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự' 
        ]);
        $user = Auth::user();
        $user->name = $request->name;
       
        if ($request->changePassword == "on") {
            $this->validate($request,[
            'password'=>'required|min:3|max:32',
            'passwordAgain'=>'required|same:password'
        ],
        [
            
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu có ít nhất 3 kí tự',
            'password.max'=>'Mật khẩu có tối đa 32 kí tự',
            'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp'
        ]);
             $user->password = bcrypt($request->password);
        } else {
            
        }
        $user->save();
        
        return redirect('nguoidung')->with('thongbao','Bạn đã sửa thành công');
    }

    function getFeedback()
    {   
        if(Auth::check())
        {
            $workcenter = Auth::user()->workcenter;
            $thongbao = ThongBao::where('Workcenter', $workcenter)->paginate(10);
            $feedback = Feedback::where('Workcenter', $workcenter)->paginate(10);
            //print_r($thongbao);
            return view('pages.feedback',compact('thongbao','feedback'));
        }else{
            return view('pages.feedback');
        }
        
    }

    function getThongBaoDaDoc($id)
    {
        $thongbao = ThongBao::find($id);
        $thongbao->DaDoc = 1;
        $thongbao->save();
        return redirect()->back();
    }
    
    public function postFeedback(Request $request)
    {
        $this->validate($request,[
            'workcenter'=>'required',
            'NoiDung'=>'required',   
        ],
        [
            'workcenter.required'=>'* Bạn chưa nhập mật khẩu',
            'NoiDung.required'=>'* Bạn chưa nhập nội dung cần phản hồi',
        ]);

        $feedback = new Feedback;
        $feedback->CO = $request->CO;
        $feedback->Workcenter = $request->workcenter;
        $feedback->Date = date('Y-m-d');
        $feedback->NoiDung = $request->NoiDung;
        $feedback->save();

        return redirect()->back()->with('thongbao1',"Bạn đã gửi thành công");
    }

    public function get5S()
    {
        $loaikhiemkhuyet = LoaiKhiemKhuyet::all();
        if(Auth::user()->workcenter == NULL)
            $defect = DefectList::all();
        else
        {
            $defect = DefectList::where('workcenter',Auth::user()->workcenter)->paginate(10);
        }
        

        return view('pages.5S',compact('loaikhiemkhuyet','defect'));
    }

    public function post5S(Request $request)
    {
        
    }

    public function post5Schitiet(Request $request,$id)
    {
        
    }

    public function getBaoLoi()
    {
        $baoloi = BaoLoi::orderBy('id','desc')->paginate(7);
        $baoloi_thongke = array();
        $baoloi_thongke['1'] = BaoLoi::all()->count();
        $baoloi_thongke['2'] = BaoLoi::where('status',1)->count();
        $baoloi_thongke['3'] = BaoLoi::whereNull('status')->count();
        $baoloi_thongke['4'] = User::all()->count();
        
        return view('pages.baoloi',compact('baoloi','baoloi_thongke'));
    }

    public function postThemLoi(Request $request)
    {
        $this->validate($request,[
            'Noidung'=>'required',
            
        ],
        [
            'Noidung.required'=>'* Bạn chưa nhập nội dung',
        ]);

        $baoloi = new BaoLoi;
        
        $baoloi->workcenter = $request->workcenter;

        $baoloi->name = Auth::user()->name;
        $baoloi->CO = $request->CO;
        $baoloi->Noidung = $request->Noidung;
        $baoloi->save();

        //------------------------------------------------------------------
        //Gửi mail
        $data['title'] = "PHẢN HỒI BÁO LỖI";
        $data['workcenter'] = $request->workcenter;
        $data['ngay'] = date('d-M-Y');
        $data['name'] = Auth::user()->name;
        $data['sdt'] = Auth::user()->sdt;
        $data['noidung'] = $request->Noidung;

        $subject = 'BÁO LỖI HỆ THỐNG - WC '.$request->workcenter;

        Mail::send('emails.email', $data, function($message) use ($subject) {
            $message->from('l3lysaght.svr01@gmail.com', 'Pre-L3 Project');
            $message->to('phuc.truong@bluescope.com')
                    ->subject($subject);
            // $message->to('phuc.truong@bluescope.com')
            //         ->subject($subject);
        });
        //------------------------------------------------------------------

        return redirect()->back()->with('thongbao2',"Bạn đã gửi thành công");
    }

    public function getBaoLoiSua($id)
    {
        $baoloi = BaoLoi::find($id);
        return view('pages.baoloisua',compact('baoloi'));
    }

    public function postBaoLoiSua($id, Request $request)
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

        $baoloi = BaoLoi::find($id);
        
        $baoloi->solution = $request->ppkhacphuc;
        $baoloi->ngayhoanthanh = date('Y-m-d');
        $baoloi->nguoigiaiquyet = $request->nguoichiutrachnhiem;
        $baoloi->status = $request->status;
        $baoloi->save();

        return redirect()->back()->with('thongbao',"Bạn đã gửi thành công");
    }
}
