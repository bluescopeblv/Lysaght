@extends('layout.index')

@section('content')
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng ký tham gia hoạt động <span style="color: blue">{{$activity->name}}</span></div>
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
				    	<form action="activity/register/{{$activity->id}}" method="post">
				    		<input type="hidden" name="_token" value="{{csrf_token()}}">
				    		<div>
				    			<label>Họ và tên</label>
							  	<input type="text" class="form-control" placeholder="Tên của bạn" name="name" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Số điện thoại</label>
							  	<input type="text" class="form-control" placeholder="Số điện thoại" name="sdt" aria-describedby="basic-addon1"
							  	>
							</div>
							
							<br>
							<button type="submit" class="btn btn-default">Đăng ký </button>

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>

@endsection