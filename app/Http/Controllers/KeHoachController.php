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
use DB;
use Mail;

class KeHoachController extends Controller
{
	function __construct()
	{
		$kehoach = KeHoach::all();
		//view::share(['kehoach'=>$kehoach]);
	}

    function getKeHoach()
    {
        return view('pages.kehoach');
    }

    function postKeHoach(Request $request)
    {
        $ngay = $request->DateFind;
        $ngay2 = $request->DateFind2;
        if(Auth::user()->quyen_preL3 >= 2){
            $workcenter = $request->workcenter;
        }else{
            $workcenter = Auth::user()->workcenter;
        }
        if(Auth::check())
        {
            //$workcenter = Auth::user()->workcenter;
            $thongtin = KeHoach::where('WorkCenter','like',"$workcenter")
                                ->where('DateSX_KH_DMY','>=',"$ngay")
                                ->where('DateSX_KH_DMY','<=',"$ngay2")
                                ->where('Plan','like',"OK")
                                ->where('DaSX2',null)
                                ->distinct()
                                ->orderBy('DateSX_KH_DMY')
                                ->orderBy('ThuTuCO')
                                ->get(['DateSX_KH_DMY','DuAn','CO','Type','Litem','NgayGH']);
            return view('pages.kehoach',['kehoach'=>$thongtin,'ngayTimKiem'=>$ngay,'wc1'=>$workcenter,'ngay2'=>$ngay2]);
        }else{
            return redirect('kehoach')->with('thongbao','Bạn chưa đăng nhập');
        }
    }
    function getChiTiet($CO,$LItem,$wc)
    {   

        $chitietCO = KeHoach::where('CO',$CO)
                            ->where('WorkCenter','like',"$wc")
                            ->where('Litem',$LItem)
                            ->where('Plan','like',"OK")
                            ->orderBy('Priority1')
                            ->orderBy('ChieuDai','desc')->orderBy('MO')->paginate(15);
        //$loaitin = LoaiTin::find($id);
        //$tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        //echo "string ".$chitietCO;
        return view('pages.chitiet',['chitietCO'=>$chitietCO,'CO'=>$CO,'Litem'=>$LItem, 'wc'=>$wc]);
    }


    function getReportAll($CO,$LItem,$wc)
    {   
        $reportall = KeHoach::where('WorkCenter','like',"$wc")
                            ->where('CO',$CO)
                            ->where('Litem',$LItem)
                            ->get();
        //$loaitin = LoaiTin::find($id);
        //$tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        foreach ($reportall as $rp) {
            //echo "string ".$rp->SLDaSX;
            $rp->DaSX2 = 1;
            if($rp->SLDaSX > 0)
            {
                $rp->SLDaSX_1 = $rp->SLDaSX;
            }
            $rp->NgaySX_TT = date('Y-m-d');
            $rp->save();
        }
        return redirect()->back()->with('thongbao','Bạn đã báo cáo thành công');
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

    public function getFeedbackTimKiem()
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
    

    public function postFeedbackTimKiem(Request $request)
    {
        $this->validate($request,[
            'workcenter'=>'required', 
        ],
        [
            'workcenter.required'=>'* Bạn chưa nhập workcenter',
        ]);
        $workcenter2 = $request->workcenter;
        $thongbao = ThongBao::where('Workcenter', $workcenter2)->orderBy('id','desc')->get();
        
        return view('pages.feedback',compact('thongbao','workcenter2'));
    }
    
    public function postFeedback(Request $request)
    {
        $this->validate($request,[
            'workcenter'=>'required',
            'NoiDung'=>'required',   
        ],
        [
            'workcenter.required'=>'* Bạn chưa nhập workcenter',
            'NoiDung.required'=>'* Bạn chưa nhập nội dung cần phản hồi',
        ]);

        $feedback = new Feedback;
        $feedback->CO = $request->CO;
        $feedback->Workcenter = $request->workcenter;
        $feedback->Date = date('Y-m-d');
        $feedback->NoiDung = $request->NoiDung;
        $feedback->save();
        //------------------------------------------------------------------
        //Gửi mail
        $data['title'] = "PHẢN HỒI TỪ OPERATOR";
        $data['workcenter'] = $request->workcenter;
        $data['ngay'] = date('d-M-Y');
        $data['name'] = Auth::user()->name;
        $data['sdt'] = Auth::user()->sdt;
        $data['noidung'] = $request->NoiDung;

        $subject = 'PRE-L3 FEEDBACK - WC '.$request->workcenter;

        Mail::send('emails.email', $data, function($message) use ($subject) {
            $message->from('l3lysaght.svr01@gmail.com', 'Pre-L3 Project');
            $message->to('lieu.tran@bluescope.com')
                    ->cc('hue.bui@bluescope.com')
                    ->cc('sanh.nguyen@bluescope.com')
                    ->cc('phuc.truong@bluescope.com')
                    ->subject($subject);
            // $message->to('phuc.truong@bluescope.com')
            //         ->subject($subject);
        });
        //------------------------------------------------------------------
        return redirect()->back()->with('thongbao1',"Bạn đã gửi thành công");
    }

    function getThongKe()
    {
        return view('pages.prel3.thongke');
    }

    function postThongKe(Request $request)
    {
        $ngay = $request->DateFind;
        if(Auth::user()->quyen_preL3 >= 2){
            $workcenter = $request->workcenter;
        }else{
            $workcenter = Auth::user()->workcenter;
        }
        if(Auth::check())
        {
            $thongtin = KeHoach::where('WorkCenter','like',"$workcenter")->where('DateSX_KH_DMY','like',"$ngay")->distinct()->orderBy('ThuTuCO')->get(['DateSX_KH_DMY','DuAn','CO','Type','Litem','NgayGH']);
            //$thongtin = KeHoach::where('WorkCenter','like',"%$workcenter%")->where('DateSX_KH_DMY','like',"$ngay")->get();
            //$thongtin = KeHoach::where('WorkCenter','like','%$workcenter%')->where('DateSX_KH_DMY','like',$ngay)->get();

            //var_dump($thongtin);
            $arrCO_all = KeHoach::where('DateSX_KH_DMY','like',"$ngay")
                            ->where('WorkCenter','like',"$workcenter")
                            ->distinct()
                            ->get(['CO','Type','Litem']);
            //var_dump($arrCO_all);

            $arrCO = KeHoach::where('NgaySX_TT','like',"$ngay")
                            ->where('WorkCenter','like',"$workcenter")
                            ->distinct()
                            ->get(['CO','Type','Litem']);

            //echo "arrCO ".$arrCO;
            $thongtin_MO_DaSX = array();
            $thongtin_KL_DaSX = array();
            $thongtin_md_DaSX = array();
            $thongtin_CO_DaSX = array();
            $thongtin_Type = array();
            $thongtin_Litem = array();

            $tong_KL = 0;
            $tong_md = 0;

            foreach ($arrCO as $CO) {
                $tongMO = KeHoach::where('NgaySX_TT','like',"$ngay")
                                ->where('WorkCenter','like',"$workcenter")
                                ->where('CO',$CO->CO)
                                ->where('Type',$CO->Type)
                                ->where('Litem',$CO->Litem)
                                ->select('MO')
                                ->count();
                $KLdaSX = KeHoach::where('NgaySX_TT','like',"$ngay")
                                ->where('WorkCenter','like',"$workcenter")
                                ->where('CO','like',$CO->CO)
                                ->where('Type',$CO->Type)
                                ->where('Litem',$CO->Litem)
                                ->select('MO')
                                ->sum('KL');
                $mddaSX = KeHoach::where('NgaySX_TT','like',"$ngay")
                                ->where('WorkCenter','like',"$workcenter")
                                ->where('CO','like',$CO->CO)
                                ->where('Type',$CO->Type)
                                ->where('Litem',$CO->Litem)
                                ->select(DB::raw('sum(SL * ChieuDai) as md'))
                                ->get('md');

                $aa = explode('"',$mddaSX);
                //echo "m dai ".$aa[3];

                $tong_KL = $tong_KL + (float)$KLdaSX;
                $tong_md = $tong_md + (float)$aa[3];

                array_push($thongtin_MO_DaSX, "$tongMO");
                array_push($thongtin_KL_DaSX, "$KLdaSX");
                array_push($thongtin_md_DaSX, "$aa[3]");
                array_push($thongtin_CO_DaSX, $CO->CO);
                array_push($thongtin_Type, $CO->Type);
                array_push($thongtin_Litem, $CO->Litem);                
            }
            $thongtin = array(
                    'Type'=> $thongtin_Type,
                    'Litem'=> $thongtin_Litem,
                    'MO' => $thongtin_MO_DaSX,
                    'KL' => $thongtin_KL_DaSX,
                    'md' => $thongtin_md_DaSX,
                    'CO' => $thongtin_CO_DaSX,
                    'len' => count($thongtin_CO_DaSX),
                    'tong_KL' => $tong_KL,
                    'tong_md' => $tong_md
            );

            //$tt = (object)$thongtin;
            //echo "Test ".$thongtin['md']['0'];
            //var_dump($thongtin);
            //var_dump($thongtin_md_DaSX);
            
            return view('pages.prel3.thongke',['ngayTimKiem'=>$ngay,'wc1'=>$workcenter,'thongtin'=>$thongtin]);
        }else{
            return redirect('thongke')->with('thongbao','Bạn chưa đăng nhập');
        }
    }

    
}
