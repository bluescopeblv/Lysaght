@extends('layout.index')


@section('content')
<div class="container">
	<div class="row">
        <!-- column -->
        <h3>Đơn vị tính: Số khiếm khuyết</h3>
        <div class="col-lg-12">
            <div>{!! $chart->container() !!}</div>
			{!! $chart->script() !!}
        </div>
    </div>
	
    <marquee>NS BLUESCOPE LYSAGHT VIETNAM - FUNCTION 5S</marquee>


</div>
@endsection

@section('content')
	<script src="js/Chart.min.js" charset="utf-8"></script>
  
@endsection