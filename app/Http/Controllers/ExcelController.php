<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\MaintenanceChiPhiSparepart;
use App\User;

class ExcelController extends Controller
//Laravel excel 2.1
{
    public function importExportView(){
        return view('import_export');
    }

    public function importFile(Request $request){

        if($request->hasFile('sample_file')){
            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = ['title' => $value->title,
                              'body' => $value->body];
                }
                if(!empty($arr)){
                    DB::table('products')->insert($arr);
                    dd('Insert Recorded successfully.');
                }
            }
        }
        dd('Đã import thành công');      
    }

    public function exportFile($type){
        $products = Product::get()->toArray();
        return \Excel::create('hdtuto_demo', function($excel) use ($products) {
            $excel->sheet('sheet name', function($sheet) use ($products)
            {
                $sheet->fromArray($products);

            });
        })->download($type);
    }      

    public function getReportChungTuThanhToan($type){
        $products = MaintenanceChiPhiSparepart::join('users','id_user','=','users.id')
                    ->select('users.name','PoNo','HDNo','supplier','tenhang','thanhtien','ngaygiao','note')
                    ->get()
                    ->toArray();
        $duoi = date('YmdHms');

        return \Excel::create('PREL3 - Chung tu thanh toan - '.$duoi, function($excel) use ($products) {
            $excel->sheet('Sheet 1', function($sheet) use ($products)
            {
                $sheet->fromArray($products);
            });
        })->download($type);
    }      
}