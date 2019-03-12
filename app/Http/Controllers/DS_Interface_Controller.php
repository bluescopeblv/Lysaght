<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DS_HR;
use App\DS_Safety;
use Carbon\Carbon;
use App\Charts\Charts;

class DS_Interface_Controller extends Controller
{
    //
    public function getInterface1()
    {
    	$hr = DS_HR::orderBy('id','DESC')->first();
        $safety = DS_Safety::orderBy('id','DESC')->first();

        $chart = new Charts;
        $chart->labels(['Jul', 'Aug', 'Sep','Oct','Nov','Dec','Jan','Feb','Mar','Apr','May','Jun','YTD']);
        $chart->dataset('Actual', 'bar', [59,60,53,60,59,60, 57, 58])->color('red')->backgroundColor('pink');
        $chart->dataset('Target', 'line', [63,63,63,63,63,63,63,63,63,63,63,63,63])->color('blue')->backgroundColor('yellow');

        //$chart->labels($campaignName);
        //$color = ['blue','red','green','yellow','pink','#cc00cc','#00cc00','#993300'];
        //$chart->dataset
        // for ($i=0; $i <= $lastKey1 ; $i++) { 
        //     $chart->dataset($group[$i],'bar',$data_out[$i])
        //           ->color($color[$i])
        //           ->backgroundColor($color[$i])
        //           ->fill(false);
        // }
        $chart->options(['color' => ['green']]);
        // $chart->options([
        //     'tooltip' => [
        //         'show' => false // or false, depending on what you want.
        //     ]

        // ]);
        
        // $chart->displayLegend(true);
        // $chart->barWidth('0.8');
        $chart2 = new Charts;
        $chart2->labels(['Jul', 'Aug', 'Sep','Oct','Nov','Dec','Jan','Feb','Mar','Apr','May','Jun','YTD']);
        $chart2->dataset('Actual', 'bar', [87,84,76,80,79,78, 76, 77])->color('green')->backgroundColor('pink');
        $chart2->dataset('Target', 'line', [75,75,75,75,75,75,75,75,75,75,75,75,75])->color('red')->backgroundColor('yellow');

        $chart3 = new Charts;
        $chart3->labels(['Jul', 'Aug', 'Sep','Oct','Nov','Dec','Jan','Feb','Mar','Apr','May','Jun','YTD']);
        $chart3->dataset('Actual', 'bar', [ ])->color('green')->backgroundColor('pink');
        $chart3->dataset('Target', 'line', [ ])->color('red')->backgroundColor('yellow');
    	return view('pages.dashboard.interface.index', compact('hr','safety','chart','chart2','chart3'));
    }

   

  

    
}
