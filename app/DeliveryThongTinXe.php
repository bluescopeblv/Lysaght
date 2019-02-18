<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryThongTinXe extends Model
{
    protected $table = "delivery_thongtinxe";

    public function delivery_detail()
    {
        return $this->hasMany('App\DeliveryDetail','thongtinxe_id','id');
    }

    public function delivery_picture()
    {
        return $this->hasMany('App\DeliveryPicture','thongtinxe_id','id');
    }

    public function thoigian_ChoChatHang() 
	{
		$time_batdauchathang = $this->thoigianbatdauchathang();
		$time_xevao = $this->thoigianxevao();
		$thoigian = Carbon::parse($time_batdauchathang)->diffInMinutes($time_xevao)/60;
		return number_format($thoigian, 2);
	}
}
