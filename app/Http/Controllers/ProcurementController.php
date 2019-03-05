<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ProcureTransport;
use App\ProcureEstimated;
use App\ProcureProduct;
use App\ProcureActivity;
use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class ProcurementController extends Controller
{
    
    public function import_thongtinxe(Request $request){

        if($request->hasFile('sample_file')){
            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            //var_dump($data);

            // foreach ($data as $key => $value) {
            // 	echo "key: ".$key. "-  value: ".$value->co;
            // 	echo " <br> ";
            // }
            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = [
                    	'CO' => $value->co,
                        'supplier_name' => $value->supplier_name,
                        'sokien' => $value->sokien,
                        'khoiluong' => $value->khoiluong,
                        'sanpham' => $value->sanpham,
                        'tentaixe' => $value->tentaixe,
                        'bienso' => $value->bienso,
                        'nhaxe' => $value->nhaxe,
                        'soluongxe' => $value->soluongxe,
                        'note' => $value->note,
                        'updated_at' => date('Y-m-d h:m:s'),
                        'created_at' => date('Y-m-d h:m:s'),
                        ];
                }
                if(!empty($arr)){
                    DB::table('delivery_thongtinxe')->insert($arr);
                    //dd('Insert Recorded successfully.');
                    return redirect()->back()->with('thongbao','Import thành công');

                }
            }
        }      
    }

    public function export_thongtinxe($type)
    {
    	$thongtinxe = DeliveryThongTinXe::select('location','distance','machinery_movement','coil_movement','accessories_movement' )->take(2)->get()->toArray();
    	//var_dump($thongtinxe);

        return \Excel::create('Sample', function($excel) use ($thongtinxe) {
            $excel->sheet('Sheet 1', function($sheet) use ($thongtinxe)
            {
                $sheet->fromArray($thongtinxe);

            });
        })->download($type);
    }

    public function getDeleteBV($id)
    {
        $thongtinxe = DeliveryThongTinXe::find($id);       
        $thongtinxe->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }

//========================================================================
//      PROCUREMENT - TRANSPORT  
//========================================================================    

    public function getList_Trans()
    {
        $transports = ProcureTransport::all();
        return view('v2.member.procurement.transport.list',compact('transports'));
    }

    public function getAdd_Trans()
    {
        return view('v2.member.procurement.transport.add');
    }
    
    public function postAdd_Trans(Request $request)
    {
        $this->validate($request,[
            'location' => 'required',
            'distance' => 'required',
            'machinery_movement' => 'required',
            'accessories_movement' => 'required',
        ],
        [
            'location.required'=>'Bạn chưa nhập địa điểm',
            'distance.required'=>'Bạn chưa nhập khoảng cách',
            'machinery_movement.required'=>'Bạn chưa nhập giá vận chuyển máy',
            'accessories_movement.required'=>'Bạn chưa nhập giá accessories',
        ]);

        $transport =  new ProcureTransport;
        $transport->location = $request->location;
        $transport->distance = $request->distance;
        $transport->machinery_movement = $request->machinery_movement;
        $transport->coil_movement = $request->coil_movement;
        $transport->accessories_movement = $request->accessories_movement;

        $transport->save();
        
        return redirect()->back()->with('thongbao','Thêm thành công');
    }

    public function getEdit_Trans($id)
    {
        $transport =  ProcureTransport::find($id);
        return view('v2.member.procurement.transport.edit',compact('transport'));
    }
    
    public function postEdit_Trans($id,Request $request)
    {
        $this->validate($request,[
            'location' => 'required',
            'distance' => 'required',
            'machinery_movement' => 'required',
            'accessories_movement' => 'required',
        ],
        [
            'location.required'=>'Bạn chưa nhập địa điểm',
            'distance.required'=>'Bạn chưa nhập khoảng cách',
            'machinery_movement.required'=>'Bạn chưa nhập giá vận chuyển máy',
            'accessories_movement.required'=>'Bạn chưa nhập giá accessories',
        ]);

        $transport =  ProcureTransport::find($id);
        $transport->location = $request->location;
        $transport->distance = $request->distance;
        $transport->machinery_movement = $request->machinery_movement;
        $transport->coil_movement = $request->coil_movement;
        $transport->accessories_movement = $request->accessories_movement;

        $transport->save();
        
        return redirect()->back()->with('thongbao','Sửa thành công');
    }

    public function exportTransport($type)
    {
        $transport = ProcureTransport::select('location','distance','machinery_movement','coil_movement','accessories_movement' )->take(2)->get()->toArray();
        //var_dump($thongtinxe);

        return \Excel::create('Sample', function($excel) use ($transport) {
            $excel->sheet('Sheet 1', function($sheet) use ($transport)
            {
                $sheet->fromArray($transport);

            });
        })->download($type);
    }

    public function importTransport(Request $request){

        if($request->hasFile('sample_file')){
            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            //var_dump($data);

            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = [
                        'location' => $value->location,
                        'distance' => $value->distance,
                        'machinery_movement' => $value->machinery_movement,
                        'coil_movement' => $value->coil_movement,
                        'accessories_movement' => $value->accessories_movement,
                        ];
                }
                if(!empty($arr)){
                    DB::table('proc_transportation_price')->insert($arr);
                    //dd('Insert Recorded successfully.');
                    return redirect()->back()->with('thongbao','Import thành công');
                }
            }
        }      
    }

    public function getDelete_Trans($id)
    {

        $transport =  ProcureTransport::find($id);
        $transport->delete();
        return redirect()->back()->with('thongbao','Delete thành công');
    }

    
//========================================================================
//      PROCUREMENT - PRODUCT  
//========================================================================
    public function getList_Prod()
    {
        $products = ProcureProduct::all();
        return view('v2.member.procurement.product.list',compact('products'));
    }

    public function getAdd_Prod()
    {
        return view('v2.member.procurement.product.add');
    }
    
    public function postAdd_Prod(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'distance_2_worker' => 'required',
            'finishgood_per_day' => 'required',
            'fuel' => 'required',
            'timber' => 'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên sản phẩm',
            'distance_2_worker.required'=>'Bạn chưa nhập khoảng cách',
            'finishgood_per_day.required'=>'Bạn chưa nhập m3/day',
            'fuel.required'=>'Bạn chưa nhập số lít dầu',
            'timber.required'=>'Bạn chưa nhập gỗ',

        ]);

        $product =  new ProcureProduct;
        $product->name = $request->name;
        $product->distance_2_worker = $request->distance_2_worker;
        $product->finishgood_per_day = $request->finishgood_per_day;
        $product->fuel = $request->fuel;
        $product->timber = $request->timber;
        $product->kg_per_m2 = $request->kg_per_m2;
        $product->pcs_default = $request->pcs_default;
        $product->w = $request->w;
        $product->covering_nylon = $request->covering_nylon;
        $product->save();
        
        return redirect()->back()->with('thongbao','Thêm thành công');
    }

    public function getEdit_Prod($id)
    {
        $product =  ProcureProduct::find($id);
        return view('v2.member.procurement.product.edit',compact('product'));
    }

    public function postEdit_Prod($id, Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'distance_2_worker' => 'required',
            'finishgood_per_day' => 'required',
            'fuel' => 'required',
            'timber' => 'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên sản phẩm',
            'distance_2_worker.required'=>'Bạn chưa nhập khoảng cách',
            'finishgood_per_day.required'=>'Bạn chưa nhập m3/day',
            'fuel.required'=>'Bạn chưa nhập số lít dầu',
            'timber.required'=>'Bạn chưa nhập gỗ',

        ]);

        $product =  ProcureProduct::find($id);
        $product->name = $request->name;
        $product->distance_2_worker = $request->distance_2_worker;
        $product->finishgood_per_day = $request->finishgood_per_day;
        $product->fuel = $request->fuel;
        $product->timber = $request->timber;
        $product->kg_per_m2 = $request->kg_per_m2;
        $product->pcs_default = $request->pcs_default;
        $product->w = $request->w;
        $product->covering_nylon = $request->covering_nylon;
        $product->save();
        
        return redirect()->back()->with('thongbao','Sửa thành công');
    }

//========================================================================
//      PROCUREMENT - ESTIMATED PRICE  
//========================================================================
    public function getList_Price() 
    {
        $estiprices = ProcureEstimated::all();
        return view('v2.member.procurement.estimatedprice.list',compact('estiprices'));
    }

    public function getAdd_Price()
    {
        return view('v2.member.procurement.estimatedprice.add');
    }
    
    public function postAdd_Price(Request $request)
    {
        $this->validate($request,[
            'crane_45_factory' => 'required',
        ],
        [
            'crane_45_factory.required'=>'Bạn chưa nhập số tiền cẩu 45 Tấn',

        ]);

        $estiprice =  new ProcureEstimated;
        $estiprice->crane_45_factory  = $request->crane_45_factory ;
        $estiprice->crane_45_site  = $request->crane_45_site ;
        $estiprice->crane_8_site  = $request->crane_8_site ;
        $estiprice->crane_liftjack  = $request->crane_liftjack ;
        $estiprice->machines_insurance  = $request->machines_insurance ;
        $estiprice->genset_hiring  = $request->genset_hiring ;
        $estiprice->fuel_genset  = $request->fuel_genset ;
        $estiprice->daunoidien  = $request->daunoidien ;
        $estiprice->electric_site  = $request->electric_site ;
        $estiprice->labour_cost  = $request->labour_cost ;
        $estiprice->health_check  = $request->health_check ;
        $estiprice->safety_certificate  = $request->safety_certificate ;
        $estiprice->insurance  = $request->insurance ;
        $estiprice->technician  = $request->technician ;
        $estiprice->timber  = $request->timber ;
        $estiprice->safety_tool  = $request->safety_tool ;
        $estiprice->covering_nylon  = $request->covering_nylon ;
        $estiprice->security  = $request->security ;
        $estiprice->save();
        
        return redirect()->back()->with('thongbao','Thêm thành công');
    }

    public function getEdit_Price($id)
    {
        $estiprice =  ProcureEstimated::find($id);
        return view('v2.member.procurement.estimatedprice.edit',compact('estiprice'));
    }

    public function postEdit_Price($id, Request $request)
    {
        $this->validate($request,[
            'crane_45_factory' => 'required',
        ],
        [
            'crane_45_factory.required'=>'Bạn chưa nhập số tiền cẩu 45 Tấn',

        ]);

        $estiprice =  ProcureEstimated::find($id);
        $estiprice->crane_45_factory  = $request->crane_45_factory ;
        $estiprice->crane_45_site  = $request->crane_45_site ;
        $estiprice->crane_8_site  = $request->crane_8_site ;
        $estiprice->crane_liftjack  = $request->crane_liftjack ;
        $estiprice->machines_insurance  = $request->machines_insurance ;
        $estiprice->genset_hiring  = $request->genset_hiring ;
        $estiprice->fuel_genset  = $request->fuel_genset ;
        $estiprice->daunoidien  = $request->daunoidien ;
        $estiprice->electric_site  = $request->electric_site ;
        $estiprice->labour_cost  = $request->labour_cost ;
        $estiprice->health_check  = $request->health_check ;
        $estiprice->safety_certificate  = $request->safety_certificate ;
        $estiprice->insurance  = $request->insurance ;
        $estiprice->technician  = $request->technician ;
        $estiprice->timber  = $request->timber ;
        $estiprice->safety_tool  = $request->safety_tool ;
        $estiprice->covering_nylon  = $request->covering_nylon ;
        $estiprice->security  = $request->security ;
        $estiprice->save();
        
        return redirect()->back()->with('thongbao','Sửa thành công');
    }

//========================================================================
//      PROCUREMENT - ACTIVITY  
//========================================================================
    public function getList_Acti() 
    {
        $estiprices = ProcureEstimated::all();
        return view('v2.member.procurement.activity.list',compact('estiprices'));
    }

    public function getFirstCheck_Acti()
    {
        $products = ProcureProduct::all();
        $transports = ProcureTransport::all();
        return view('v2.member.procurement.activity.firstcheck', compact('products','transports'));
    }

    public function postFirstCheck_Acti(Request $request)
    {
        //dd($request->firstcheck == 1);
        if($request->firstcheck == 1){
            return view('v2.member.procurement.activity.sorry')->with('thongbao','Thêm thành công');
        }else {
            $products = ProcureProduct::all();
            $transports = ProcureTransport::all();
            return view('v2.member.procurement.activity.add', compact('products','transports'));
        }
    }

    public function getAdd_Acti()
    {
        $products = ProcureProduct::all();
        $transports = ProcureTransport::all();
        return view('v2.member.procurement.activity.add', compact('products','transports'));
    }
    
    public function postAdd_Acti(Request $request)
    {
        $this->validate($request,[
            'quantity' => 'required',
            'length' => 'required',
        ],
        [
            'quantity.required'=>'Bạn chưa nhập khối lượng dự án',
            'length.required'=>'Bạn chưa nhập chiều dài tối đa',
        ]);
        
        $product =  ProcureProduct::find($request->procu_production_norm_id);
        $estiprice = ProcureEstimated::orderby('id','desc')->first();
        $transport = ProcureTransport::find($request->proc_transportation_price_id);

        //Khối lượng, số tấn
        $weight = ($product->kg_per_m2 * $request->quantity )/1000 + 2;

        $price_crane_45_factory = $estiprice->crane_45_factory * 2 * 1;
        $price_crane_45_site = $estiprice->crane_45_site * 2 * 1;
        $price_crane_80_site = $estiprice->crane_80_site * 2 * 1;
        $price_crane_8_site = $estiprice->crane_8_site * ceil($weight/20) * 1; // Số lần cẩu coil
        $price_crane_liftjack = $estiprice->crane_liftjack * 1 * 1;
        $price_transport_machine = ($transport->machinery_movement * 1000) * 2* 1;
        $price_hamer_liftjack = ($transport->machinery_movement * 1000 + 1000000) * 2* 1;
        $price_transport_acc = ($transport->accessories_movement * 1000) * 2* 1;


        //Crane Price
        if ( $request->bl_mini_layout == "on") {
            //MB hẹp
            $price_toiuu_crane = $price_crane_45_factory
                               + $price_crane_80_site
                               + $price_transport_machine
                               + $price_crane_8_site;
        } else {
            //MB rộng
            //PA1: Hamer Liftjack

            $price_pa1 = $price_transport_machine 
                       + $price_crane_8_site;
                       + 1000000
                       + $estiprice->crane_8_site;   //Tăng 1 lần cẩu coil
            //PA2: Liftjack
            $price_pa2 = $price_transport_machine 
                       + $price_crane_8_site
                       + $estiprice->crane_8_site;   //Tăng 1 lần cẩu coil
            //PA3: Binh thường
            $price_pa3 = $price_crane_45_factory 
                       + $price_crane_45_site
                       + $price_crane_8_site
                       + $price_transport_machine;   //Tăng 1 lần cẩu coil

            if( $request->crane_option == 0 ) {
                $price_toiuu_crane = $price_pa3; 
            }elseif ( $request->crane_option == 1 ) {
                $price_toiuu_crane = $price_pa1; 
            }elseif ( $request->crane_option == 2 ) {
                $price_toiuu_crane = $price_pa2; 
            }else{
                $price_toiuu_crane = min($price_pa1, $price_pa2, $price_pa3);
            }
        }


        $price_machines_insurance = $estiprice->machines_insurance * 2 * 1;
        $price_transport_coil = ($transport->coil_movement * 1000) * ceil($weight/20)* 1;

        //Số ngày cán tôn
        $run_day = ceil($request->quantity / $product->finishgood_per_day);

        $price_genset_hiring = $estiprice->genset_hiring * 1 * ($run_day +2);
        $price_fuel_genset = $estiprice->fuel_genset * 100 * ($run_day);
        $price_daunoidien = $estiprice->daunoidien * 2* 1;
        $price_electric_site = $estiprice->electric_site * $run_day* 1;

        //Dien cong truong
        if($request->bl_electric_site == 0 ){
            //May phat
            $price_electric = $price_genset_hiring + $price_fuel_genset;
        }else{
            $price_electric = $price_daunoidien + $price_electric_site;
        }

        $qty_labour = ceil($request->length / $product->distance_2_worker);
        $price_labour_cost  = $estiprice->labour_cost * ($qty_labour + 1) * ($run_day +2);
        $price_health_check  = $estiprice->health_check * ($qty_labour + 1) * 1;
        $price_safety_certificate  = $estiprice->safety_certificate * ($qty_labour + 1) * 1;
        $price_insurance  = $estiprice->insurance * ($qty_labour + 1) * 1;
        //Chi phí nhân công
        if ( $request->bl_operator_blv == 0) {
            //Lysaght
            $price_labour = $price_labour_cost + $price_health_check + $price_safety_certificate + $price_insurance;
        } else {
            //Khach hang
            $price_labour = 0;
        }
        
        //Số lượng technician
        if ($request->bl_technician == 0) {
            $qty_technician = 3;
        } else {
            $qty_technician = 2;
        }
        $price_technician = $estiprice->technician * $qty_technician * ($run_day +2); //2 ngày setup

        //Tính số gỗ
        if ($request->pcs_per_packet == "Default") {
            $timer_m3 = $product->timber;
            $pcs = $product->pcs_default;
        } else {
            $timer_m3 = ($product->pcs_default / $request->pcs_per_packet ) * $product->timber;
            $pcs = $request->pcs_per_packet;
        }
        $price_timber = $estiprice->timber * ($request->quantity / 1000) * $timer_m3 * 1;
        //dd( $price_timber );

        $price_safety_tool = $estiprice->safety_tool * 1 * 1;
        $price_covering_nylon = $estiprice->covering_nylon * ($request->quantity / 1000) *$product->covering_nylon * 1;
        $price_security = $estiprice->security * 1 * ($run_day +2); //2 ngày setup
        //Chi phi phat sinh so vi tri chay may can
        if($request->point_run_number == 1 ){
            $price_point_run_number = 0;
        }else{
            $price_point_run_number = $request->point_run_number * 18000000;
        }
        //Chi phi phat sinh so vi tri dat hang thanh pham
        if($request->point_finishgood_number == 1 ){
            $price_point_finishgood_number = 0;
        }else{
            $price_point_finishgood_number = $request->point_finishgood_number * 5000000;
        }
        
        //---------
        //Tong gia =
        $price_out_service = $price_toiuu_crane         //Chi phi cau + van chuyen
                           + $price_transport_acc       //Chi phi van chuyen ACC
                           + $price_machines_insurance  //Bao hiem may moc
                           + $price_transport_coil      //Chuyen coil
                           + $price_electric            //Chi phi dien
                           + $price_labour
                           + $price_technician
                           + $price_timber
                           + $price_safety_tool
                           + $price_covering_nylon
                           + $price_security
                           + $price_point_run_number
                           + $price_point_finishgood_number;


        if ($price_out_service * 0.13 < 20000000) {
            $price_service = 20000000;
        } else {
            $price_service = $price_out_service*0.13;
        }

        $price_include_service = $price_out_service + $price_service;
        //dd($price_include_service);

        //Hiển thị kích thước mặt bằng
        if ( $request->bl_mini_layout == "on") {
            //MB hẹp
            $a = 30;
            $b = 8;
        } else {
            $a = 45;
            $b = 12;
        }
        //Nếu cán dưới thấp - trên cao
        if ($request->bl_layout_low == 0) {
            $L = $request->length + 3;
        } else {
            $L = $request->length + 18;
        }

        $array_keys = array(
                'price_toiuu_crane', 
                'price_transport_acc',
                'price_machines_insurance', 
                'price_transport_coil',
                'price_electric',
                'price_labour',
                'price_technician',
                'price_timber',
                'price_safety_tool',
                'price_covering_nylon',
                'price_security',
                'price_point_run_number',
                'price_point_finishgood_number',
                'price_service',
                'qty_labour',
            );
        $array_values = array(
                $price_toiuu_crane, 
                $price_transport_acc,
                $price_machines_insurance,
                $price_transport_coil,
                $price_electric,
                $price_labour,
                $price_technician,
                $price_timber,
                $price_safety_tool,
                $price_covering_nylon,
                $price_security,
                $price_point_run_number,
                $price_point_finishgood_number,
                $price_service,
                $qty_labour,
            );
        $detail_price = array_combine($array_keys, $array_values);
        $js_detail_price = json_encode($detail_price);
        
        //dd($js_detail_price);


        $activity = new ProcureActivity;
        $activity->quantity = $request->quantity;
        $activity->thickness = $request->thickness;
        $activity->length = $request->length;
        $activity->bl_electric_site  = $request->bl_electric_site ;
        $activity->bl_technician  = $request->bl_technician ;
        $activity->bl_operator_blv  = $request->bl_operator_blv ;
        $activity->bl_layout_low  = $request->bl_layout_low ;
        $activity->a  = $a ;
        $activity->b  = $b ;
        $activity->L  = $L ;
        $activity->totalcost  = $price_include_service ;
        $activity->weight  = $weight ;
        $activity->para  = $js_detail_price ;

        $activity->crane_option  = $request->crane_option ;
        $activity->pcs_per_packet  = $pcs ;
        $activity->point_run_number   = $request->point_run_number  ;
        $activity->point_finishgood_number   = $request->point_finishgood_number  ;
        $activity->proc_transportation_price_id   = $transport->id  ;
        $activity->procu_production_norm_id   = $product->id  ;
        $activity->procu_estimated_price_id   = $estiprice->id  ;
        $activity->user_id   =  Auth::id();
        $activity->save();

        $id = ProcureActivity::orderBy('created_at', 'desc')->first()->id;

        return view('v2.member.procurement.activity.result',compact('price_include_service','run_day','request', 'id','a','b','L','js_detail_price','qty_labour'));
    }

    public function postReview_Acti(Request $request)
    {
        $activity =  ProcureActivity::find($request->id);
        $activity->status = 1;
        $activity->save();
        return redirect()->back()->with('thongbao','Đã gửi Procurement thành công');
    }

//========================================================================
//      PROCUREMENT - REVIEW  
//========================================================================
    public function getList_Review()
    {
        $activities = ProcureActivity::where('status','>=', 1)
                                    ->where('user_id',Auth::user()->id)
                                    ->orderBy('updated_at','desc')
                                    ->get();
        return view('v2.member.procurement.review.list',compact('activities'));
    }

    public function getListAd_Review()
    {
        $activities = ProcureActivity::where('status','>=', 1)
                                    ->where('user_id',Auth::user()->id)
                                    ->orderBy('updated_at','desc')
                                    ->get();
        return view('v2.member.procurement.review.list_ad',compact('activities'));
    }

    public function getEdit_Review($id)
    {
        $products = ProcureProduct::all();
        $transports = ProcureTransport::all();
        $activity = ProcureActivity::find($id);
        return view('v2.member.procurement.review.edit', compact('activity','transports'));
    }

    public function getConfirm_Review($id)
    {
        $products = ProcureProduct::all();
        $transports = ProcureTransport::all();
        $activity = ProcureActivity::find($id);
        $detail_price = json_decode($activity->para);
        return view('v2.member.procurement.review.confirm', compact('activity','transports','detail_price'));
    }
    

    public function postConfirm_Review($id, Request $request)
    {
        $activity = ProcureActivity::find($id);
        $activity->status = 2;
        $activity->note = $request->note;
        $activity->save();
        return redirect()->back()->with('thongbao','Updated thành công');
    }   

    public function postNoAgree_Review($id, Request $request)
    {
        $activity = ProcureActivity::find($id);
        $activity->status = 3;
        $activity->note = $request->note;
        $activity->save();
        return redirect()->back()->with('thongbao','Updated thành công');
    }   



}
