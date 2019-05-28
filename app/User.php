<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comment()
    {
        return $this->hasMany('App\Comment','idUser','id');
    }

    public function maintenancechiphisparepart()
    {
        return $this->hasMany('App\MaintenanceChiPhiSparepart','id_user','id');
    }

    public function delivery_hoatdong()
    {
        return $this->hasMany('App\DeliveryHoatDong','id_user','id');
    }

    public function music_acitvity()
    {
        return $this->hasMany('App\MusicActivity','id_user','id');
    }

    public function procu_activity()
    {
        return $this->hasMany('App\ProcureActivity','id_user','id');
    }

    public function outs_maint_activity()
    {
        return $this->hasMany('App\OutMaintActivity','outs_maint_machine_id','id');
    }
}
