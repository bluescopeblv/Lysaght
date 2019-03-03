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

class PagesController extends Controller
{
	function __construct()
	{
		$theloai = TheLoai::all();
		$slide = Slide::all();
		view::share(['theloai'=>$theloai, 'slide'=>$slide]);

		if(Auth::check())
		{
			view::share(['nguoidung'=> Auth::user()]);
		}
	}
    function trangchu()
    {
    	return view('pages.trangchu');
    }

    function lienhe()
    {
    	return view('pages.lienhe');
    }
    function loaitin($id)
    {
    	$loaitin = LoaiTin::find($id);
    	$tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
    	return view('pages.loaitin',['loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }
    function tintuc($id)
    {
    	$tintuc = TinTuc::find($id);
    	$tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
    	$tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
    	return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }

    function getDangNhap()
    {
    	return view('pages.dangnhap');
    }
    function postDangNhap(Request $request)
    {
    	$this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:3|max:32',   
        ],
        [
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu có ít nhất 3 kí tự',
            'password.max'=>'Mật khẩu có tối đa 32 kí tự',
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            if (User::where('email',$request->email)->first()->ver == true ) {
                return redirect('procurement/activity/firstcheck');
            } else {
                return redirect('trangchu');
            }
            
            
        }
        else{
            return redirect('dangnhap')->with('thongbao','Đăng nhập không thành công');
        }

    	//echo "Ten dang nhap: ".$request->email;
    	//echo "<br>";
    	//echo "Mat khẩu: ".$request->password;
    	//return view('pages.dangnhap');
    }

    function getDangXuat()
    {
    	Auth::logout();
    	return redirect('trangchu');
    }

    function getNguoiDung()
    {
    	$user = Auth::user();
    	return view('pages.nguoidung',['nguoidung'=>$user]);
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
        $user->sdt = $request->sdt;
        $user->sdt2 = $request->sdt2;
        $user->workcenter = $request->workcenter;
        
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

    function getDangKy()
    {
    	
    	return view('pages.dangky');
    }

    function postDangKy(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'required|min:3|max:32',
            'email'=>'required',
            'password'=>'required|min:3|max:32',
            'passwordAgain' =>  'required|same:password'
        ],
        [
        	'name.required'=>'Bạn chưa nhập tên',
        	'name.min'=>'Tên người dùng có ít nhất 3 kí tự',
        	'name.max'=>'Tên người dùng có tối đa 32 kí tự',
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu có ít nhất 3 kí tự',
            'password.max'=>'Mật khẩu có tối đa 32 kí tự',
            'passwordAgain.required' =>'Bạn chưa nhập mật khẩu',
            'passwordAgain.same' =>'Mật khẩu nhập lại chưa khớp',
        ]);

        $user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = 0;
        $user->save();

        return redirect('dangky')->with('thongbao','Chúc mừng bạn đăng ký thành công');
    }

    function postTimKiem(Request $request)
    {
  		$tukhoa = $request->tukhoa;
  		$tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->orWhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
    	return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }

    
}
