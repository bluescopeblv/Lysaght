<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MusicInfo;
use App\MusicActivity;
use DB;
use Mail;
use Carbon\Carbon;

class MusicController extends Controller
{
//==========================================================================
//          BẢO VỆ
//==========================================================================
    public function getList_Info()
    {
    	$songs = MusicInfo::all();
    	return view('v2.member.music.list',compact('songs'));
    }

    public function getAdd_Info()
    {
    	return view('v2.member.music.add');
    }

    public function postAdd_Info(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required',
            'linkfile'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên bài hát',
            'linkfile.required'=>'Bạn chưa nhập link file',
        ]);

        $songs = new MusicInfo;
        $songs->name = $request->name;

        //Kiểm tra file
        if ($request->hasFile('linkfile')) {
            $file = $request->linkfile;

            $fullName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $fullNameLenght = strlen($fullName);
            $extensionLenght = strlen($extension);
            $nameLength = $fullNameLenght - ($extensionLenght + 1);
            $onlyName = substr($fullName, 0, $nameLength);

            $fileNewName = $onlyName.'_'.date('YmdHis').'.'.$file->getClientOriginalExtension();

            $file->move('upload/music/lib',$fileNewName);
            $songs->linkfile = $fileNewName;
        }
       
        $songs->save();
        return redirect()->back()->with('thongbao','Thêm thành công');
    }

    public function getEditBV($id)
    {
    	$thongtinxe = DeliveryThongTinXe::find($id);
    	return view('pages.delivery.baove.edit',compact('thongtinxe'));
    }

    public function postEditBV(Request $request,$id)
    {
    	$this->validate($request,[
            'tentaixe' => 'required',
            'bienso'=>'required',
            'taitrongxe' => 'required',
            'chieudaixe'=>'required',
        ],
        [
            'tentaixe.required'=>'Bạn chưa nhập tên tài xế',
            'bienso.required'=>'Bạn chưa nhập biển số xe',
            'taitrongxe.required'=>'Bạn chưa nhập tải trọng xe',
            'chieudaixe.required'=>'Bạn chưa nhập chiều dài xe'
        ]);

        $thongtinxe = DeliveryThongTinXe::find($id);
        $thongtinxe->khachhang = $request->khachhang;
        $thongtinxe->tentaixe = $request->tentaixe;
        $thongtinxe->bienso = $request->bienso;
        $thongtinxe->nhaxe = $request->nhaxe;
        $thongtinxe->taitrongxe = $request->taitrongxe;
        $thongtinxe->chieudaixe = $request->chieudaixe;
        $thongtinxe->thoigianxevao = $request->thoigianxevao;
        $thongtinxe->thoigianxera =  $request->thoigianxera;

        //echo "string".date('Y-m-d H:i:s');
       
        $thongtinxe->save();
        return redirect()->back()->with('thongbao','Sửa thành công');
    }

    public function getDeleteBV($id)
    {
        $thongtinxe = DeliveryThongTinXe::find($id);       
        $thongtinxe->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }



}