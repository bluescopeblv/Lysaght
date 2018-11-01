<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Workcenter;
use App\ThongBao;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('pages.kehoach',function($view)
        {
           $workcenter = Workcenter::all();
           $view->with('workcenter',$workcenter);
        });

        view()->composer('pages.feedback',function($view)
        {
           $workcenter = Workcenter::all();
           $view->with('workcenter',$workcenter);
        });
        view()->composer('pages.nguoidung',function($view)
        {
           $workcenter = Workcenter::all();
           $view->with('workcenter',$workcenter);
        });
        view()->composer('layout.header',function($view)
        {
            if(Auth::user()){
                if(Auth::user()->workcenter != ""){
                    $workcenter = Auth::user()->workcenter;
                    $tb = ThongBao::where('Workcenter','like',"$workcenter")->where('DaDoc','=',NULL)->get();
                    //$tb = ThongBao::where('DaDoc','=',0)->get();
                    $sl = count($tb);
                    $view->with('sl',$sl);
                }else{
                    $sl = 0;
                    $view->with('sl',$sl);
                }
            }else{
                    $sl = 0;
                    $view->with('sl',$sl);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
