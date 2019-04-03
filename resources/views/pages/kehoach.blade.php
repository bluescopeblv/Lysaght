@extends('layout.index')

@section('content')
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">
				  	<div class="panel-heading">KẾ HOẠCH SẢN XUẤT | <a href="thongke">>> Thống kê</a></div>
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

		                        <form action="kehoach" method="POST">
				                    <input type="hidden" name="_token" value="{{csrf_token()}}">
				                    
				                    <input  type="date" id="myDate" class="form-control" name="DateFind" value="{{ date('Y-m-d') }}" style="display: inline;width: 15%">
				                    <input  type="date" class="form-control" name="DateFind2" value="{{ date('Y-m-d') }}" style="display: inline;width: 15%">
				                   	
				                    @if(Auth::user())

				                    @if(Auth::user()->quyen_preL3 >= 2)
				                   	<select class="form-control" name="workcenter" style="display: inline;width: 20%" >
							            <option style="font-size: 16px; color:blue" value="">--Chọn workcenter--</option>
								        @foreach($workcenter as $wc)
								            <option style="font-size: 16px; color:blue" value="{{$wc->name}}">{{ $wc->name }}</option>
								            
								        @endforeach
							        </select>
							      
							        @endif

							        @endif

				                    <!-- <input  type="text" id="workcenter" class="form-control" name="workcenter" value="Purlin400" style="display: inline;width: 20%" placeholder="Nhập workcenter"> -->
				
				                    <button type="submit" class="btn btn-default">Xem kế hoạch </button>
				                    <hr>
				                </form>

				                @if(isset($ngayTimKiem))
				               		<h4>Ngày <span style="color: blue">{{date('d-m-Y',strtotime($ngayTimKiem))}}</span> đến <span style="color: blue">{{date('d-m-Y',strtotime($ngay2))}}</span> Bạn đang ở workcenter <span style="color: blue">{{$wc1}}</span> </h4>
				               	@endif
						    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		                    
				                    <thead>
				                        <tr align="center">
				                            <th>ID</th>
				                            <th>Ngày SX</th>
				                            <th>TT</th>
				                            <th>Dự án</th>
				                            <th>CO</th>
				                            <th>Type</th>
				                            <th>LItem</th>
				                            <th>Ngày giao hàng</th>
				                            
				                            <th>Chi tiết</th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                    	@if(isset($kehoach))
					                        @foreach($kehoach as $kh)
					                        <tr class="odd gradeX" align="center">
					                            <td>{{$kh->id}}</td>
					                            <td>{{date('d-M-Y', strtotime($kh->DateSX_KH_DMY))}}</td>
					                            <td>{{$kh->ThuTuCO}}</td>
					                            <td>{{$kh->DuAn}}</td>
					                            <td>{{$kh->CO}}</td>
					                            <td>{{$kh->Type}}</td>
					                            <td>{{$kh->Litem}}</td>
					                            <td>{{$kh->NgayGH}}</td>
					                            
					                            <td class="center"><i class="glyphicon glyphicon-th-list"></i> <a href="chitiet/{{$kh->CO}}/{{$kh->Litem}}/{{$wc1}}/{{date('Ymd', strtotime($kh->DateSX_KH_DMY))}}/{{$kh->ThuTuCO}}"> Chi tiết...</a></td>
					                        </tr>
					                        @endforeach
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