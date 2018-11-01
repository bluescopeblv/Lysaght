@extends('layout.index')

@section('content')
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">
				  	<div class="panel-heading">THỐNG KÊ SẢN XUẤT | THỰC TẾ</div>
				  	@if(Auth::user())
					  	@if(Auth::user()->quyen_preL3 >= 1)
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

		                        <form action="thongke" method="POST">
				                    <input type="hidden" name="_token" value="{{csrf_token()}}">
				                    
				                    <input  type="date" id="myDate" class="form-control" name="DateFind" value="{{ date('Y-m-d') }}" style="display: inline;width: 15%">

				                   	
				                    @if(Auth::user())

				                    @if(Auth::user()->quyen_preL3 >= 2)
				                   	<select class="form-control" name="workcenter" style="display: inline;width: 20%" >
							            <option style="font-size: 16px; color:blue" value="">--Chọn workcenter--</option>
								        
								        <option style="font-size: 16px; color:blue" value=""></option>
								        
							        </select>
							      
							        @endif

							        @endif

				                    <!-- <input  type="text" id="workcenter" class="form-control" name="workcenter" value="Purlin400" style="display: inline;width: 20%" placeholder="Nhập workcenter"> -->
				
				                    <button type="submit" class="btn btn-default">Tìm kiếm</button>
				                    <hr>
				                </form>

				                @if(isset($ngayTimKiem))
				               		<h4>Ngày <span style="color: blue">{{date('d-m-Y',strtotime($ngayTimKiem))}}</span> - Bạn đang ở workcenter <span style="color: blue"> {{$wc1}}</span> </h4>
				               	@endif
						    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		                    
				                    <thead>
				                        <tr align="center">
				                            <th>ID</th>
				                            
				                            <th>Ngày SX Thực tế</th>
				                            <th>CO</th>
				                            <th>Type</th>
				                            <th>Litem</th>
				                            <th>Số MO</th>
				                            <th>KL (Tấn)</th>
				                            <th>Mét dài (mm)</th>
				                            
				                            <th>Chi tiết</th>
				                        </tr>
				                    </thead>

				                    <tbody>
				                    	@if(isset($thongtin))
					                        @for($i = 0;$i < $thongtin['len'];$i++)
					                        <tr class="odd gradeX" align="center">
					                            <td></td>	                      
					                            <td>{{date('d-M-Y',strtotime($ngayTimKiem))}}</td>
					                            <td>{{$thongtin['CO'][$i]}}</td>
					                            <td>{{$thongtin['Type'][$i]}}</td>
					                            <td>{{$thongtin['Litem'][$i]}}</td>
					                            <td>{{$thongtin['MO'][$i]}}</td>
					                            <td>{{$thongtin['KL'][$i]}}</td>
					                            <td>{{number_format($thongtin['md'][$i])}}</td>
					                            <td class="center"><i class="glyphicon glyphicon-th-list"></i> <a> Chi tiết...</a></td>
					                        </tr>
					                        
					                        @endfor
					                        <tr style="color: blue;">
					                        	<th colspan="6">Tổng</th>
					                        	<th style="text-align: center;">{{number_format($thongtin['tong_KL'],4)}}</td>
					                        	<th style="text-align: center;">{{number_format($thongtin['tong_md'])}}</td>
					                        	<th></th>
					                        </tr>
					                    @endif
				                    </tbody>
				                </table>
						    	
						  	</div>
						@else
							<h3 style="color: green;text-align: center;" > Bạn không có quyền truy cập vào module này. Để được cấp quyền vui lòng liên hệ foreman hoặc Phúc</h3>
						@endif
					@else
						<h3 style="color: green;text-align: center;" > Bạn vui lòng đăng nhập để xem nội dung.</h3>
				  	@endif
				</div>
            </div>
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