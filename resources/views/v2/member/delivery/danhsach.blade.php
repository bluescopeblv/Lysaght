@extends('layout.index')

@section('content')
    <div class="container">
    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>

            <!-- DANH SÁCH GIAO HÀNG -->
            <div class="col-md-12">
                <div class="panel panel-primary ">
				  	<div class="panel-heading">GIAO HÀNG | DELIVERY</div>
				  	<div class="panel-body">

				  		@if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}           
                            </div>
                        @endif

		               	<div class="button button1"><a href="delivery/baove">BẢO VỆ</a></div>
		               	<div class="button button1"><a href="delivery/logistic">LOGISTIC</a></div>
		               	<div class="button button1"><a href="delivery/giaohang">GIAO HÀNG</a></div>
                        <div class="button button1"><a href="delivery/warehouse">KHO</a></div>
                        <div class="button button1"><a href="delivery/interface">GIAO DIỆN</a></div>
		                <hr>
				    	
		                <marquee>DELIVERY - GIAO HÀNG</marquee>
				  	</div>
				</div>
            </div>
            <!-- End DANH SÁCH GIAO HÀNG -->
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
@endsection

@section('script')
	<script>
	  	
	</script>
@endsection