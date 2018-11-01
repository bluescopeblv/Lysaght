<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\MaintenanceIndex;
use App\MaintenanceMachine;
use App\MaintenanceChiPhiSparepart;
use App\Charts\SampleChart;
use Carbon\Carbon;
use Illuminate\Support\Collection;


class MaintenanceController extends Controller
{

    public function getDanhSachAdmin()
    {
        $chiso = MaintenanceIndex::all();
        $cacmay = MaintenanceMachine::all();
        return view('admin.maintenance.danhsach',compact('chiso','cacmay'));
    }

    function getDanhSach()
    {
        $chiso = MaintenanceIndex::all();
        $cacmay = MaintenanceMachine::all();
        return view('pages.maintenance.danhsach',compact('chiso','cacmay'));
    }

    public function getThem()
    {
        return view('admin.maintenance.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request,[
            'machine' => 'required',
            'code'=>'required',
        ],
        [
            'machine.required'=>'Bạn chưa nhập tên máy',
            'code.required'=>'Bạn chưa nhập code'
        ]);

        $maint = new MaintenanceMachine;
        $maint->machine = $request->machine;
        $maint->code = $request->code;
        $maint->reportM3 = $request->reportM3;
        $maint->note = $request->note;
        $maint->save();
        return redirect('admin/maintenance/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id)
    {
        $machine = MaintenanceMachine::find($id);
        return view('admin.maintenance.sua',compact('machine'));
    }
    
    public function postSua(Request $request, $id)
    {
        $this->validate($request,[
            'machine' => 'required',
            'code'=>'required',
        ],
        [
            'machine.required'=>'Bạn chưa nhập tên máy',
            'code.required'=>'Bạn chưa nhập code'
        ]);

        $maint = MaintenanceMachine::find($id);
        $maint->machine = $request->machine;
        $maint->code = $request->code;
        $maint->reportM3 = $request->reportM3;
        $maint->note = $request->note;
        $maint->save();
        return redirect('admin/maintenance/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getSuaChiSo($id)
    {
        $chiso = MaintenanceIndex::find($id);
        return view('admin.maintenance.sua_chiso',compact('chiso'));
    }

    public function postSuaChiSo($id, Request $request)
    {
        $chiso = MaintenanceIndex::find($id);
        $chiso->sovuhuhong = $request->sovuhuhong;
        $chiso->thoigianpervu = $request->thoigianpervu;
        $chiso->preventive = $request->preventive;
        $chiso->save();
        return redirect('admin/maintenance/sua_chiso/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getResetall()
    {
        $machine = MaintenanceMachine::all();
        foreach ($machine as $mc) {
            $mc->reportM3 = 0;
            $mc->note = NULL;
            $mc->save();
        }
        return redirect()->back();
    }

    public function getQuanLyChiPhi()
    {
        if(Auth::user()->quyen_baotri >=2){
            $chiphi = MaintenanceChiPhiSparepart::all();
        }else{
            $chiphi = MaintenanceChiPhiSparepart::where('id_user',Auth::user()->id)->get();
        }
        
        return view('pages.maintenance.chiphisparepart',compact('chiphi'));
    }

    public function getThemRecordChiPhi()
    {
        return view('pages.maintenance.themchiphi');
    }

    public function postThemRecordChiPhi(Request $request)
    {
        $this->validate($request,[
            'tenhang' => 'required',
            'itemNo' => 'required',
            'PoNo'=>'required',
            'HDNo'=>'required',
            'donvitinh' => 'required',
            'soluongnhap'=>'required',
            'dongia' => 'required',
        ],
        [
            'tenhang.required'=>'Bạn chưa nhập tên hàng',
            'itemNo.required'=>'Bạn chưa nhập số Item',
            'PoNo.required'=>'Bạn chưa nhập số PO',
            'HDNo.required'=>'Bạn chưa nhập số hóa đơn',
            'donvitinh.required'=>'Bạn chưa chọn đơn vị tính',
            'soluongnhap.required'=>'Bạn chưa nhập số lượng',
            'dongia.required'=>'Bạn chưa chọn đơn giá',
        ]);

        $chiphi = new MaintenanceChiPhiSparepart;
        $chiphi->tenhang = $request->tenhang;
        $chiphi->id_user = Auth::user()->id;
        $chiphi->ngaynhap = date('Y-m-d H:m:s');
        $chiphi->itemNo = $request->itemNo;
        $chiphi->PoNo = $request->PoNo;
        $chiphi->HDNo = $request->HDNo;
        $chiphi->donvitinh = $request->donvitinh;
        $chiphi->soluongnhap = $request->soluongnhap;
        $chiphi->dongia = $request->dongia;
        $chiphi->thanhtien = $request->soluongnhap * $request->dongia;
        $chiphi->ngaygiao = date('Y-m-d H:m:s');
        $chiphi->khuvuc = $request->khuvuc;
        $chiphi->note = $request->note;
        $chiphi->supplier = $request->supplier;

        //Kiểm tra file
        if ($request->hasFile('fileChungtu')) {
            $file = $request->fileChungtu;
            //Lấy Tên files
            // echo 'Tên Files: ' . $file->getClientOriginalName();
            // echo '<br/>';
            //Lấy Đuôi File
            // echo 'Đuôi file: ' . $file->getClientOriginalExtension();
            // echo '<br/>';

            // //Lấy đường dẫn tạm thời của file
            // echo 'Đường dẫn tạm: ' . $file->getRealPath();
            // echo '<br/>';

            // //Lấy kích cỡ của file đơn vị tính theo bytes
            // echo 'Kích cỡ file: ' . $file->getSize();
            // echo '<br/>';

            // //Lấy kiểu file
            // echo 'Kiểu files: ' . $file->getMimeType();

            $fullName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $fullNameLenght = strlen($fullName);
            $extensionLenght = strlen($extension);
            $nameLength = $fullNameLenght - ($extensionLenght + 1);
            $onlyName = substr($fullName, 0, $nameLength);

            $fileNewName = $onlyName.'_'.date('YmdHis').'.'.$file->getClientOriginalExtension();

            $file->move('upload/maintenance/chungtu',$fileNewName);
            $chiphi->tenchungtu = $fileNewName;
        }

        $chiphi->save();
        return redirect('maint_quanlychiphi/them')->with('thongbao','Thêm thành công');
    }

    public function getSuaRecordChiPhi($id)
    {
        $chiphi = MaintenanceChiPhiSparepart::find($id);
        return view('pages.maintenance.suachiphi',compact('chiphi'));
    }

    public function postSuaRecordChiPhi($id, Request $request)
    {
        $this->validate($request,[
            'tenhang' => 'required',
            'itemNo' => 'required',
            'PoNo'=>'required',
            'HDNo'=>'required',
            'donvitinh' => 'required',
            'soluongnhap'=>'required',
            'dongia' => 'required',
        ],
        [
            'tenhang.required'=>'Bạn chưa nhập tên hàng',
            'itemNo.required'=>'Bạn chưa nhập số Item',
            'PoNo.required'=>'Bạn chưa nhập số PO',
            'HDNo.required'=>'Bạn chưa nhập số hóa đơn',
            'donvitinh.required'=>'Bạn chưa chọn đơn vị tính',
            'soluongnhap.required'=>'Bạn chưa nhập số lượng',
            'dongia.required'=>'Bạn chưa chọn đơn giá',
        ]);

        $chiphi = MaintenanceChiPhiSparepart::find($id);
        $chiphi->tenhang = $request->tenhang;
        $chiphi->id_user = Auth::user()->id;
        $chiphi->ngaynhap = $request->ngaynhap;
        $chiphi->itemNo = $request->itemNo;
        $chiphi->PoNo = $request->PoNo;
        $chiphi->HDNo = $request->HDNo;
        $chiphi->donvitinh = $request->donvitinh;
        $chiphi->soluongnhap = $request->soluongnhap;
        $chiphi->dongia = $request->dongia;
        $chiphi->thanhtien = $request->soluongnhap * $request->dongia;
        $chiphi->ngaygiao = $request->ngaygiao;
        $chiphi->note = $request->note;
        $chiphi->khuvuc = $request->khuvuc;
        $chiphi->supplier = $request->supplier;
        
        $fileNameCu = $request->fileNameCu;
        //echo "fileNameCu hihi: ".$fileNameCu;
        //Kiểm tra file
        if ($request->hasFile('fileChungtu')) {
            //echo "Có fileốiiws";
            if($fileNameCu <> ""){
                //$pathFileCu = public_path('upload/maintenance/delete/'.$fileNameCu);
                if(file_exists(public_path("upload/maintenance/chungtu/".$fileNameCu))){
                    unlink(public_path("upload/maintenance/chungtu/".$fileNameCu));
                }

                //echo "Có file cũ";
            }
            

            $file = $request->fileChungtu;

            $fullName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $fullNameLenght = strlen($fullName);
            $extensionLenght = strlen($extension);
            $nameLength = $fullNameLenght - ($extensionLenght + 1);
            $onlyName = substr($fullName, 0, $nameLength);

            $fileNewName = $onlyName.'_'.date('YmdHis').'.'.$file->getClientOriginalExtension();

            $file->move('upload/maintenance/chungtu',$fileNewName);
            $chiphi->tenchungtu = $fileNewName;
        }
        $chiphi->save();
        return redirect('maint_quanlychiphi/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoaRecordChiPhi($id)
    {
        $chiphi = MaintenanceChiPhiSparepart::find($id);
        $chiphi->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }

    public function getThongKeChart()
    {
        $begin = Carbon::create(2018, 8, 01, 0, 0, 0);

        $now  = Carbon::now();
        $now_month = $now->month;
        //$dt = $now->subHours($begin);

        $soThang =  $now->diffInMonths($begin);
        $data1 = [];
        $data2 = []; 
        for ($i=1; $i <= $soThang; $i++) { 
            $monthNew = $begin->addMonth()->month;

            $start = Carbon::create(2018, $monthNew, 01, 1, 1, 0)->startOfDay()->toDateTimeString();
            $end   = Carbon::create(2018, $monthNew, 01, 1, 1, 0)->endOfMonth()->toDateTimeString();

            $chiphi = MaintenanceChiPhiSparepart::where('ngaynhap','>=', $start)
                        ->where('ngaynhap','<',$end)->sum('thanhtien');

            array_push($data1, "Tháng ".$begin->month);
            array_push($data2, $chiphi/1000000);
        }
        
        $chart = new SampleChart;
        $chart->labels($data1);
        $chart->dataset('Chi phí', 'line', $data2)->color('blue');
        $chart->options(['color' => ['green']]);

        // $chart->dataset('datasheet2', 'line', [4,7,1,1]);

        return view('pages.maintenance.thongke.list', compact('chart'));


    }
}
