<?php

// Mở composer.json
// Thêm vào trong "autoload" chuỗi sau
// "files": [
//         "app/function/function.php"
// ]

// Chạy cmd : composer  dumpautoload

use Carbon\Carbon;


function changeTitle($str,$strSymbol='-',$case=MB_CASE_LOWER){// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
	$str=trim($str);
	if ($str=="") return "";
	$str =str_replace('"','',$str);
	$str =str_replace("'",'',$str);
	$str = stripUnicode($str);
	$str = mb_convert_case($str,$case,'utf-8');
	$str = preg_replace('/[\W|_]+/',$strSymbol,$str);
	return $str;
}

function stripUnicode($str){
	if(!$str) return '';
	//$str = str_replace($a, $b, $str);
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
		'ae'=>'ǽ',
		'AE'=>'Ǽ',
		'c'=>'ć|ç|ĉ|ċ|č',
		'C'=>'Ć|Ĉ|Ĉ|Ċ|Č',
		'd'=>'đ|ď',
		'D'=>'Đ|Ď',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
		'f'=>'ƒ',
		'F'=>'',
		'g'=>'ĝ|ğ|ġ|ģ',
		'G'=>'Ĝ|Ğ|Ġ|Ģ',
		'h'=>'ĥ|ħ',
		'H'=>'Ĥ|Ħ',
		'i'=>'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',	  
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
		'ij'=>'ĳ',	  
		'IJ'=>'Ĳ',
		'j'=>'ĵ',	  
		'J'=>'Ĵ',
		'k'=>'ķ',	  
		'K'=>'Ķ',
		'l'=>'ĺ|ļ|ľ|ŀ|ł',	  
		'L'=>'Ĺ|Ļ|Ľ|Ŀ|Ł',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
		'Oe'=>'œ',
		'OE'=>'Œ',
		'n'=>'ñ|ń|ņ|ň|ŉ',
		'N'=>'Ñ|Ń|Ņ|Ň',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
		's'=>'ŕ|ŗ|ř',
		'R'=>'Ŕ|Ŗ|Ř',
		's'=>'ß|ſ|ś|ŝ|ş|š',
		'S'=>'Ś|Ŝ|Ş|Š',
		't'=>'ţ|ť|ŧ',
		'T'=>'Ţ|Ť|Ŧ',
		'w'=>'ŵ',
		'W'=>'Ŵ',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
		'z'=>'ź|ż|ž',
		'Z'=>'Ź|Ż|Ž'
	);
	foreach($unicode as $khongdau=>$codau) {
		$arr=explode("|",$codau);
		$str = str_replace($arr,$khongdau,$str);
	}
	return $str;
}

function activityDemSoNguoiThamDu($id)
{
	$songuoi = count(App\Activity::where('id_tenhoatdong',$id)->get());
	return $songuoi;
}

function getLoaiKhiemKhuyet($id)
{
	$loaikhiemkhuyet = App\LoaiKhiemKhuyet::find($id);
	return $loaikhiemkhuyet->name;
}

function getSoLuongCO($id)
{
	//$thongtinxe = App\DeliveryThongTinXe::find($id);
	return count(App\DeliveryDetail::where('thongtinxe_id',$id)->get());
}

function getDeliveryCO($id)
{
	$temp1 = "";
	$thongtinxe = App\DeliveryDetail::where('thongtinxe_id',$id)->get();
	foreach ($thongtinxe as $key => $val) {
		$temp1 = $temp1.$val->CO.".";
	}
	return $temp1;
}

function getDeliverySoAnh($id)
{
	//$thongtinxe = App\DeliveryThongTinXe::find($id);
	return count(App\DeliveryPicture::where('thongtinxe_id',$id)->get());
}

function getDeliveryStatus($status)
{
	if($status == 10 )
        return '<span class="label label-info">Kế hoạch</span>';
    else if($status == 20)
        return '<span class="label label-warning">Xe đã vào</span>';
    elseif($status == 30)
        return '<span class="label label-warning">Chờ thanh toán</span>';
    elseif($status == 40)
        return '<span class="label label-success">Cho phép chất hàng</span>';
    elseif($status == 50)
        return '<span class="label label-info">Đang chất hàng</span>';
    elseif($status == 60)
        return '<span class="label label-success">Đã chất hàng xong</span>';
    elseif($status == 70)
        return '<span class="label label-danger">Reject</span>';
    elseif($status == 80)
        return '<span class="label label-success">Xong thủ tục</span>';
    elseif($status == 90)
        return '<span class="label label-danger">Xe đã ra</span>';
    
    else{
        return '<span class="label label-danger">NO DEFINE</span>';
    }
    
}

function getDelivery_Public_Display($public_display)
{
	if($public_display == false ){
        return '<span class="label label-danger">NO DISPLAY</span>';
    }
}

function get5Sdanhgia($id)
{
	//$thongtinxe = App\DeliveryThongTinXe::find($id);
	return count(App\Chamdiem::where('campaign_id',$id)->get());
}

function get5Scauhoi($id)
{
	//$thongtinxe = App\DeliveryThongTinXe::find($id);
	return App\Question::find($id);
}

function getDiem_5S_Nhom($chamdiem_id)
{
	//$thongtinxe = App\DeliveryThongTinXe::find($id);
	//$campaign = App\Campaign::find($campaign_id);
    $tongdiem = 5*count(App\Chitiet::where('chamdiem_id',$chamdiem_id)->get());
    $diem = App\Chitiet::where('chamdiem_id',$chamdiem_id)->sum('diem');
    if ($tongdiem > 0) {
    	return $diem*100/$tongdiem;
    } else {
    	return 0;
    }   
	
}

function getDiem_5S_fsGroup($campaign_id, $fs_group_id)
{
	//dd($fs_group_id);
	$nhanviengroups = App\NhanvienGroup::all();
	$Sum = 0;
	$count = 0;
	foreach ($nhanviengroups as $key => $val) {
		if ($val->fs_group_id == $fs_group_id ) {
			$chamdiem = App\Chamdiem::where('nhanvien_group_id',$val->id)
								->where('campaign_id', $campaign_id)
								->first();
			if($chamdiem){
				$Sum = $Sum + getDiem_5S_Nhom($chamdiem->id);
				$count = $count + 1;
			}
		} else {
			# code...
		}
	}
    
    if ($count > 0 ) {
    	return $Sum/$count;
    } else {
    	return 0;
    }
}

function get_DS_Safety_Date_LTI($LTI_date)
{
	return Carbon::parse($LTI_date)->diffInDays(Carbon::now());
}

function get_DS_Safety_Date_MTI($MTI_date)
{
	return Carbon::parse($MTI_date)->diffInDays(Carbon::now());
}

function get_Delivery_Minute($date) //Car in factory
{
	return Carbon::parse($date)->diffInMinutes(Carbon::now()); //diffInHours
}

//===================================================================================
// Delivery
//===================================================================================

	function get_Delivery_ThoiGian_ChoChatHang($time_xevao, $time_batdauchathang) 
	{
		//return Carbon::parse($date)->diffInMinutes(Carbon::now()); //diffInHours
		$thoigian = Carbon::parse($time_batdauchathang)->diffInMinutes($time_xevao)/60;
		return $thoigian;
	}

	function get_Delivery_ThoiGian_ChatHang($time_batdauchathang, $time_xongchathang) 
	{
		//return Carbon::parse($date)->diffInMinutes(Carbon::now()); //diffInHours
		$thoigian = Carbon::parse($time_xongchathang)->diffInMinutes($time_batdauchathang)/60;
		return $thoigian;
	}

	function get_Delivery_ThoiGian_ChoDN($time_xongchathang, $thoigianxongDN) 
	{
		//return Carbon::parse($date)->diffInMinutes(Carbon::now()); //diffInHours
		if(Carbon::parse($thoigianxongDN) > Carbon::parse($time_xongchathang) )
		{
			$thoigian = Carbon::parse($thoigianxongDN)->diffInMinutes($time_xongchathang)/60;
			return $thoigian;
		}else{
			return 0;
		}
	}

	function get_Delivery_ThoiGian_ChoDO_PXK($time_xongchathang, $thoigianxongPXK) 
	{
		if(Carbon::parse($thoigianxongPXK) > Carbon::parse($time_xongchathang) && $thoigianxongPXK != Null)

		{
			//echo Carbon::parse($thoigianxongPXK);

			$thoigian = Carbon::parse($thoigianxongPXK)->diffInMinutes($time_xongchathang)/60;
			return $thoigian;
		}else{
			return 0;
		}
	}

	function get_Delivery_ThoiGian_BanGiaoDN($time_xongchathang, $thoigianxongDN, $thoigianbagiaoDN)
	{
		if(Carbon::parse($thoigianxongDN) > Carbon::parse($time_xongchathang) )
		{
			$thoigian = Carbon::parse($thoigianxongDN)->diffInMinutes($time_xongchathang)/60;
			return $thoigian;
		}else{ //Xong truoc
			$thoigian = Carbon::parse($thoigianbagiaoDN)->diffInMinutes($time_xongchathang)/60;
			return $thoigian;
		}
	}

	function get_Delivery_TongThoiGian($time_xevao, $time_batdauchathang, $time_xongchathang, $thoigianxongDN, $thoigianxongPXK, $thoigianbagiaoDN)
	{
		$kq = get_Delivery_ThoiGian_ChoChatHang($time_xevao, $time_batdauchathang)
			+ get_Delivery_ThoiGian_ChatHang($time_batdauchathang, $time_xongchathang)
			+ get_Delivery_ThoiGian_ChoDN($time_xongchathang, $thoigianxongDN) 
			+ get_Delivery_ThoiGian_ChoDO_PXK($time_xongchathang, $thoigianxongPXK) 
			+ get_Delivery_ThoiGian_BanGiaoDN($time_xongchathang, $thoigianxongDN, $thoigianbagiaoDN);
		return $kq;

	}

	function doithoigian($value)
	{
		if($value*60 < 60 ){
			return '0:'.$value*60;
		}else{
			$thapphan = CEIL(($value - FLOOR($value))*60);
			return FLOOR($value).':'.$thapphan;
		}
	}

	function doithoigian_hhmmss($value)
	{
			return $value;
	}

	function delivery_soGio($value)
	{
		return substr($value,0,strpos($value,":"));
	}

	function delivery_soPhut($value)
	{
		return substr($value,strpos($value,":")+1, strlen($value));
	}

	function getDeliveryDetail($id)
	{
		$details = App\DeliveryDetail::where('thongtinxe_id',$id)->get();
		$temp = "";
		foreach ($details as $key => $val) {
			if ($temp) {
				$temp = $temp.";  ".$val->CO.":".$val->sanpham."-".$val->chitietgiaohang;
			} else {
				$temp = $val->CO.":".$val->sanpham."-".$val->chitietgiaohang;
			}
		}

		return $temp;
	}


	function getROS_TotalCost($request)
	{
		$product   =  App\ProcureProduct::find($request->procu_production_norm_id);
        $estiprice = App\ProcureEstimated::orderby('id','desc')->first();
        $transport = App\ProcureTransport::find($request->proc_transportation_price_id);

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

        return $price_include_service;
	}

	function getROS_RunDay($request)
	{
		$product   = App\ProcureProduct::find($request->procu_production_norm_id);
        $estiprice = App\ProcureEstimated::orderby('id','desc')->first();
        $transport = App\ProcureTransport::find($request->proc_transportation_price_id);

        //Số ngày cán tôn
        $run_day = ceil($request->quantity / $product->finishgood_per_day);

        return $run_day;
	}

	function getROS_Weigh($request)
	{
		$product   = App\ProcureProduct::find($request->procu_production_norm_id);
        //Khối lượng, số tấn
        $weight = ($product->kg_per_m2 * $request->quantity )/1000 + 2;

        return $weight;
	}

	function getROS_status($id)
	{
		$status   = App\ProcureActivity::find($id)->status;
		if($status == 1 )
	        return '<span class="label label-info">Wait review</span>';
	    else if($status == 2)
	        return '<span class="label label-success">Reviewed by Procurement</span>';
	    elseif($status == 3)
	        return '<span class="label label-warning">Procurement not agree</span>';
	    else {
	    	return '';
	    }

	}
?>