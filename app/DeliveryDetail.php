<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
    protected $table = "delivery_detail";

    public function delivery_thongtinxe()
    {
    	return $this->belongsTo('App\DeliveryThongTinXe','thongtinxe_id','id');
    }
}
