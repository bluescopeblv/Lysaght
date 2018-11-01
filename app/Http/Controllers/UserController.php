<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;


class UserController extends Controller
{
    public function getDanhSach()
    {
    	$user = User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getSua($id)
    {
       
    	$user = User::find($id);
    	return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id)
    {
    	$this->validate($request,[
            'name'=>'required|min:3',
            
        ],
        [
            'name.required'=>'Bạn chưa nhập tên',
            'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự'
            
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->workcenter = $request->workcenter;
        $user->sdt = $request->sdt;
        $user->sdt2 = $request->sdt2;
        $user->quyen = $request->quyen;
        $user->quyen_preL3 = $request->quyen_preL3;
        $user->quyen_5s = $request->quyen_5s;
        $user->quyen_baotri = $request->quyen_baotri;
        $user->quyen_baoloi = $request->quyen_baoloi;
        $user->quyen_activity = $request->quyen_activity;
        $user->quyen_delivery = $request->quyen_delivery;

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
        
        return redirect('admin/user/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }
    //-----------------------------------------
    public function getXoa($id)
    {
    	$user = User::find($id);
    	$user->delete();
    	return redirect('admin/user/danhsach')->with('thongbao','Bạn đã xóa người dùng thành công');
    }
	//-----------------------------------------
    public function getThem()
    {   
        
    	return view('admin.user.them');
    }

    public function postThem(Request $request)
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
        $user->workcenter = $request->workcenter;
        $user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;
        $user->save();
    	

    	return redirect('admin/user/them')->with('thongbao','Thêm thành công');
    }


    public function getDangNhapAdmin()
    {
        return view('admin.login');
    }

    public function postDangNhapAdmin(Request $request)
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
            return redirect('admin/user/danhsach');
        }
        else{
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }

    public function getDangXuatAdmin()
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
