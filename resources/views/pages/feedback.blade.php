@extends('layout.index')

@section('content')
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>

            <div class="col-md-12"> <!-- Thông báo -->
                <div class="panel panel-info">
				  	<div class="panel-heading">THÔNG BÁO TỪ KẾ HOẠCH</div>
				  	@if(Auth::user())
					  	@if(Auth::user()->quyen_preL3 >= 1)
						  	<div class="panel-body">
						  		

		                        @if(session('thongbao'))
		                            <div class="alert alert-success">
		                                {{session('thongbao')}}           
		                            </div>
		                        @endif

		                        @if(Auth::user()->quyen_preL3 >= 2)
		                        <form action="feedback_tk" method="POST">
				                    <input type="hidden" name="_token" value="{{csrf_token()}}">
				                    
				                    <!-- <input  type="date" id="myDate" class="form-control" name="DateFind" value="{{ date('Y-m-d') }}" style="display: inline;width: 20%"> -->
									@if(Auth::user())

				                    @if(Auth::user()->quyen_preL3 >= 1)
				                   	<select class="form-control" name="workcenter" style="display: inline;width: 20%" >
							            <option style="font-size: 16px; color:blue" value="">--Chọn workcenter--</option>
								        @foreach($workcenter as $wc)
								            <option style="font-size: 16px; color:blue" value="{{$wc->name}}">{{ $wc->name }}</option>
								        @endforeach
							        </select>
							        @else
							        <select class="form-control" name="workcenter" style="display: inline;width: 20%" >
							            <option style="font-size: 16px; color:blue" value="">--Chọn workcenter--</option>
								        @foreach($workcenter as $wc)
								            <option style="font-size: 16px; color:blue" value="{{$wc->name}}">{{ $wc->name }}</option>
								        @endforeach
							        </select>
							        @endif

							        @endif
				                    <button type="" class="btn btn-default">Tìm kiếm</button>
				                    <hr>
				                </form>
				                @endif

				                @if(isset($workcenter2))
				               		<h4 style="color: blue">Bạn đang ở workcenter {{ $workcenter2 }} </h4>
				               	@endif

						    	
						    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				                    <thead>
				                        <tr align="center">
				                            <th>ID</th>
				                            <th>Ngày thông báo</th>
				                            <th>CO</th>
				                            <th>Nội dung thông báo</th>
				                            <th>Đã đọc</th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                    	@if(isset($thongbao))
					                        @foreach($thongbao as $tb)
					                        <tr class="odd gradeX" align="center">
					                            <td>{{$tb->id}}</td>
					                            <td>{{date('d-M-Y', strtotime($tb->Date1))}}</td>
					                            <td>{{$tb->CO}}</td>
					                            <td>{{$tb->NoiDung}}</td>
					                            <td>@if($tb->DaDoc == 0)
					                            		<a href="thongbao_dadoc/{{$tb->id}}" style="color:red">Chưa đọc</a>
					                            	@else
					                            		<span style="color: green">{{'Đã đọc'}}</span> 
					                            @endif</td>
					                            
					                        </tr>
					                        @endforeach
					                    @endif
				                    </tbody>

				                </table> 
				                <div>@if(Session('thongbao')) {{$thongbao->links()}} @endif </div>
						  	</div>
						@else
							<h4 style="color: green;text-align: center;" > Bạn không có quyền truy cập vào module này. Để được cấp quyền vui lòng liên hệ foreman hoặc Phúc</h4>
						@endif
					@else
						<h4 style="color: green;text-align: center;" > Bạn vui lòng đăng nhập để xem nội dung.</h4>
				  	@endif
				</div>
            </div> <!-- End Thông báo -->

            <!-- FEEDBACK -->
            <div class="col-md-12">
                <div class="panel panel-primary ">
				  	<div class="panel-heading">DANH SÁCH CÁC PHẢN HỒI/ LIST OF FEEDBACKS</div>
				  	@if(Auth::user())
					  	@if(Auth::user()->quyen_preL3 >= 1)
						  	<div class="panel-body">
						  		

		                        @if(session('thongbao'))
		                            <div class="alert alert-success">
		                                {{session('thongbao')}}           
		                            </div>
		                        @endif

		                        <form action="" method="POST">
				                    <input type="hidden" name="_token" value="{{csrf_token()}}">
				                    
				                    <input  type="date" id="myDate" class="form-control" name="DateFind" value="{{ date('Y-m-d') }}" style="display: inline;width: 20%">
				
				                    <button type="" class="btn btn-default">Tìm kiếm</button>
				                    <hr>
				                </form>

				                @if(isset($ngayTimKiem))
				               		<h4>Ngày {{date('d-m-Y',strtotime($ngayTimKiem))}} </h4>
				               	@endif

						    	<!-- Thông báo -->
						    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				                    <thead>
				                        <tr align="center">
				                            <th>ID</th>
				                            <th>Ngày</th>
				                            <th>CO</th>
				                            <th>Nội dung</th>
				                            <th>Đã đọc</th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                    	@if(isset($feedback))
					                        @foreach($feedback as $fb)
					                        <tr class="odd gradeX" align="center">
					                            <td>{{$fb->id}}</td>
					                            <td>{{date('d-M-Y', strtotime($fb->Date))}}</td>
					                            
					                            <td>{{$fb->CO}}</td>
					                            <td>{{$fb->NoiDung}}</td>
					                            <td>@if($fb->DaDoc == 1)
					                            		<span style="color: green">Đã đọc</span>
					                            	@else
					                            		 <span style="color:red">Chưa đọc</span>
					                            @endif</td>
					                        </tr>
					                        @endforeach
					                    @endif
				                    </tbody>
				                </table> <!-- End Thông báo -->
				                <div>@if(Session('feedback')) {{$feedback->links()}} @endif </div>
				                <hr>
						    	
						    	<!-- form -->
						    	@if(Auth::user())
						    	<div class="col-md-12">
							    	<div class="panel panel-info">
									    <div class="panel-heading">PHẢN HỒI</div>
									    <div class="panel-body">
									    	@if(count($errors)>0)
					                            <div class="alert alert-danger">
					                                @foreach($errors->all() as $err)
					                                    {{$err}}<br>
					                                @endforeach
					                            </div>
					                        @endif

					                        @if(session('thongbao1'))
					                            <div class="alert alert-success">
					                                {{session('thongbao1')}}           
					                            </div>
					                        @endif
									    	<form action="feedback" method="post">
							                    <input type="hidden" name="_token" value="{{csrf_token()}}">
							                    <div class="form-group">
							                        <label>CO</label>
							                        <input class="form-control" name="CO" placeholder="Nhập số CO" />
							                    </div>
							                    <div class="form-group">
							                        <label>Workcenter</label>
							                        <select class="form-control" name="workcenter">
							                        	@if(Auth::user())
								                            <option value="{{Auth::user()->workcenter}}">{{Auth::user()->workcenter}}</option>
								                        @endif
							                        </select>
							                    </div>
							                    
							                    <div class="form-group">
							                        <label>Nội dung cần phản hồi*</label>
							                        <input class="form-control" name="NoiDung" placeholder="Nhập nội dung cần phản hồi..." />
							                    </div>
							                    
							                    <button type="submit" class="btn btn-default">Thêm</button>
							                    <button type="reset" class="btn btn-default">Làm mới</button>
							                </form>



									    </div>
								    </div>
								</div>
								@else
									Đăng nhập để phản hồi!
								@endif
						    	<!-- end form -->
						    	
						  	</div>
						@else
							<h4 style="color: green;text-align: center;" > Bạn không có quyền truy cập vào module này. Để được cấp quyền vui lòng liên hệ foreman hoặc Phúc</h4>
						@endif
					@else
						<h4 style="color: green;text-align: center;" > Bạn vui lòng đăng nhập để xem nội dung.</h4>
				  	@endif
				</div>
            </div>
            <!-- End FEEDBACK -->
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>

@endsection

@section('content')
  <script>
	    $( function() {
		    $( "#datepicker" ).datepicker({
		      showButtonPanel: true
		    });
		  } );

  </script>
@endsection