<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SampleChart;

class ChartsController extends Controller
{
    public function chart()
    {
    	$chart = new SampleChart;
    	$chart->labels(['One', 'Two', 'Three','Four']);
    	$chart->dataset('datasheet1', 'line', [1,1,5,4]);
    	$chart->dataset('datasheet2', 'line', [4,7,1,1]);

    	return view('pages.chart.chart_view', compact('chart'));

    }

    public function chart_bar()
    {
    	$chart = new SampleChart;
    	$chart->labels(['One', 'Two', 'Three','Four']);
    	$chart->dataset('datasheet1', 'bar', [10,2,9.3,8.5]);
    	$chart->dataset('datasheet2', 'bar', [4,13,2.6,1]);
    	return view('pages.chart.chart_view', compact('chart'));
    }
}
