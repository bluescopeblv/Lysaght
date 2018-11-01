<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryPicture extends Model
{
    protected $table = "delivery_picture";

    public function delivery_thongtinxe()
    {
    	return $this->belongsTo('App\DeliveryThongTinXe','thongtinxe_id','id');
    }
}
