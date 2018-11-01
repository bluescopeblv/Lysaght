<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\ActivityList;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function getList()
    {
        $today = Carbon::now();
    	$activity = ActivityList::orderBy('ngaybatdau','desc')->get();
    	return view('pages.activity.list',compact('activity','today'));
    }

    public function getRegister($id)
    {
    	$activity = ActivityList::find($id);
    	return view('pages.activity.register',compact('activity'));
    }

    public function postRegister($id, Request $request)
    {
    	$this->validate($request,[
            'name' => 'required|min:2|max:32',
            'sdt'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên',
            'name.min'=>'Tên bạn ngắn quá',
            'name.max'=>'Tên bạn dài quá',
            'sdt.required'=>'Bạn chưa nhập SĐT. Nhập SĐT vào để người khác liên lạc bạn',
        
        ]);
    	
    	$activity = new Activity;
    	$activity->hovaten = $request->name;
    	$activity->sdt = $request->sdt;
        $activity->id_tenhoatdong = $id;
        $activity->save();
    
    	return redirect()->back()->with('thongbao','Bạn đã đăng kí thành công');
    }

    public function getRegisted($id)
    {
    	$danhsach = Activity::where('id_tenhoatdong',$id)->get();
    	$hoatdong = ActivityList::find($id);
    	$tenhoatdong = $hoatdong->name;
    	return view('pages.activity.list_registed',compact('danhsach','tenhoatdong','hoatdong'));
    }

    public function getList_Admin()
    {
        $activity = ActivityList::orderBy('ngaybatdau','desc')->get();
        return view('admin.activity.list',compact('activity'));
    }

    public function getThem_Admin()
    {
        return view('admin.activity.add');
    }

    public function postThem_Admin(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'ngaybatdau'=>'required',
            'deadline'=>'required',
            'noidung'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên',
            'ngaybatdau.required'=>'Bạn chưa nhập ngày bắt đầu',
            'deadline.required'=>'Bạn chưa nhập ngày kết thúc',
            'noidung.required'=>'Bạn chưa nhập nội dung',
        ]);
        
        $activity = new ActivityList;
        $activity->name = $request->name;
        $activity->ngaybatdau = $request->ngaybatdau;
        $activity->deadline = $request->deadline;
        $activity->noidung = $request->noidung;
        $activity->giaithuong = $request->giaithuong;

        //Kiểm tra file
        if ($request->hasFile('tenfile')) {
            $file = $request->tenfile;

            $fullName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $fullNameLenght = strlen($fullName);
            $extensionLenght = strlen($extension);
            $nameLength = $fullNameLenght - ($extensionLenght + 1);
            $onlyName = substr($fullName, 0, $nameLength);

            $fileNewName = $onlyName.'_'.date('YmdHis').'.'.$file->getClientOriginalExtension();

            $file->move('upload/activity/files',$fileNewName);
            $activity->tenfile = $fileNewName;
        }

        $activity->save();
    
        return view('admin.activity.list')->with('thongbao','Bạn đã thêm hoạt động thành công');
    }

    public function getEdit_Admin($id)
    {
        $activity = ActivityList::find($id);
        return view('admin.activity.edit',compact('activity'));
    }
    
    public function postEdit_Admin($id, Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'ngaybatdau'=>'required',
            'deadline'=>'required',
            'noidung'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên',
            'ngaybatdau.required'=>'Bạn chưa nhập ngày bắt đầu',
            'deadline.required'=>'Bạn chưa nhập ngày kết thúc',
            'noidung.required'=>'Bạn chưa nhập nội dung',
        ]);
        
        $activity = ActivityList::find($id);
        $activity->name = $request->name;
        $activity->ngaybatdau = $request->ngaybatdau;
        $activity->deadline = $request->deadline;
        $activity->noidung = $request->noidung;
        $activity->giaithuong = $request->giaithuong;

        $fileNameCu = $request->tenfile;
        //Kiểm tra file
        if ($request->hasFile('tenfile')) {
            if($fileNameCu <> ""){
                //$pathFileCu = public_path('upload/maintenance/delete/'.$fileNameCu);
                if(file_exists(public_path("upload/activity/files/".$fileNameCu))){
                    unlink(public_path("upload/activity/files/".$fileNameCu));
                }
            }
            

            $file = $request->tenfile;

            $fullName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $fullNameLenght = strlen($fullName);
            $extensionLenght = strlen($extension);
            $nameLength = $fullNameLenght - ($extensionLenght + 1);
            $onlyName = substr($fullName, 0, $nameLength);

            $fileNewName = $onlyName.'_'.date('YmdHis').'.'.$file->getClientOriginalExtension();

            $file->move('upload/activity/files',$fileNewName);
            $activity->tenfile = $fileNewName;
        }

        $activity->save();
    
        return redirect()->back()->with('thongbao','Bạn đã sửa thành công');

        
        
    }
    

}
