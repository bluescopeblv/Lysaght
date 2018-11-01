@extends('layout.index')

@section('content')
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Danh sách đã đăng kí hoạt động <span style="color: blue; font-size: 18px">{{ $tenhoatdong }}</span></div>
				  	<div class="panel-body">
				  		<h5>Nội dung: {{$hoatdong->noidung}}</h5>
                        <h5>Giải thưởng: {{$hoatdong->giaithuong}}</h5>
                        <h5>Xem thêm file: @if($hoatdong->tenfile) <a href="upload/activity/files/{{$hoatdong->tenfile}}"> Xem </a>@else Chưa có file @endif</h5>
                        <hr>
                        Danh sách đăng kí tham gia
				    	@foreach($danhsach as $ds)
                            <p>{{ $ds->hovaten }}</p>
                        @endforeach
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>

@endsection