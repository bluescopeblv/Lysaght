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
	return $diem*100/$tongdiem;
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

?>