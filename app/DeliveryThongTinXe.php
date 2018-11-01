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
}
