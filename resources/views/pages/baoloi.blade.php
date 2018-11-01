@extends('layout.index')

@section('content')
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>
            <!-- Báo lỗi -->
            <div class="col-md-12">
                <div class="panel panel-primary ">
				  	<div class="panel-heading">DANH SÁCH RECORD LỖI HỆ THỐNG | SYSTEM ERROR </div>
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

                        <form action="" method="">
		                    <input type="hidden" name="_token" value="{{csrf_token()}}">
		                    
		                    <input  type="date" id="datepicker" class="form-control" name="DateFind" value="{{ date('Y-m-d') }}" style="display: inline; width: 20%">
		
		                    <button type="" class="btn btn-default">Tìm kiếm</button>
		                    <hr>
		                </form>

		                @if(isset($ngayTimKiem))
		               		<h4>Ngày {{date('d-m-Y',strtotime($ngayTimKiem))}} </h4>
		               	@endif
		               	<!-- Dashboard -->
		               	<div class="row">
					        <div class="col-lg-3 col-xs-6">
						        <!-- small box -->
						        <div class="small-box bg-aqua">
						            <div class="inner">
						              <h3>{{ $baoloi_thongke['1'] }}</h3>

						              <p>Issues</p>
						            </div>
						            <div class="icon">
						              <i class="ion ion-bag"></i>
						            </div>
						            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						          </div>
						        </div>
						        <!-- ./col -->
					        <div class="col-lg-3 col-xs-6">
					          	<!-- small box -->
					          	<div class="small-box bg-green">
						            <div class="inner">
						              <h3>{{ $baoloi_thongke['2'] }}</h3>

						              <p>Đã giải quyết</p>
						            </div>
						            <div class="icon">
						              <i class="ion ion-stats-bars"></i>
						            </div>
						            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					          	</div>
					        </div>
					        <!-- ./col -->
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-red">
					            <div class="inner">
					              <h3>{{ $baoloi_thongke['3'] }}</h3>

					              <p>Chưa giải quyết</p>
					            </div>
					            <div class="icon">
					              <i class="ion ion-person-add"></i>
					            </div>
					            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					        </div>
					        <!-- ./col -->
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-yellow">
					            <div class="inner">
					              <h3>{{ $baoloi_thongke['4'] }}</h3>

					              <p>Tổng user hiện tại</p>
					            </div>
					            <div class="icon">
					              <i class="ion ion-pie-graph"></i>
					            </div>
					            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					        </div>
					        <!-- ./col -->
					    </div>
					    <!-- End Dashboard -->
				    	<!-- Thông báo -->
				    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		                    <thead>
		                        <tr align="center">
		                            <th>ID</th>
		                            <th>Ngày</th>
		                            <th>Tên</th>
		                            <th>Workcenter</th>
		                            <th>CO</th>
		                            <th>Nội dung</th>
		                            <th>Nguyên nhân</th>
		                            <th>Người giải quyết</th>
		                            @if(Auth::user())
			                            @if(Auth::user()->quyen >= 2)
				                            
				                            <th>Complete date</th>
				                            
				                            <th>Báo cáo</th>
			                            @endif
		                            @endif
		                            <th>Status</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	@if(isset($baoloi))
			                        @foreach($baoloi as $bl)
			                        <tr class="odd gradeX" align="center">
			                            <td>{{$bl->id}}</td>
			                            <td>{{date('d-M-Y', strtotime($bl->created_at))}}</td>
			                            <td>{{$bl->name}}</td>
			                            <td>{{$bl->workcenter}}</td>
			                            <td>{{$bl->CO}}</td>
			                            <td>{{$bl->Noidung}}</td>
			                            <td>{{$bl->solution}}</td>
			                            <td>{{$bl->nguoigiaiquyet}}</td>
			                            @if(Auth::user())
				                            @if(Auth::user()->quyen >= 2)
				                            	
					                            <td>@if($bl->ngayhoanthanh) {{date('d-M-Y', strtotime($bl->ngayhoanthanh))}} @else @endif</td>
					                            
					                            <td>
					                            	<a href="baoloi-sua/{{$bl->id}}" class="btn btn-info btn-sm">
	          											<span class="glyphicon glyphicon-floppy-save"></span> Report
	        										</a>
					                            </td>
				                            @endif
				                        @endif
			                            <td>@if($bl->status == 1)
			                            		<span style="color: green">Done</span>
			                            	@else
			                            		 <span style="color:red">Chưa giải quyết</span>
			                            @endif</td>
			                        </tr>
			                        @endforeach
			                    @endif
		                    </tbody>
		                </table> <!-- End Thông báo -->
		                <div style="text-align: center;">
		                	{{$baoloi->links()}} 
		                </div>
		                <hr>
				    	
				    	<!-- form -->
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

			                        @if(session('thongbao2'))
			                            <div class="alert alert-success">
			                                {{session('thongbao2')}}           
			                            </div>
			                        @endif
			                        
			                        @if(Auth::user())
			                        <!-- RECORD LỖI -->
							    	<form action="baoloi-themloi" method="post">
					                    <input type="hidden" name="_token" value="{{csrf_token()}}">
					                    <div class="form-group">
					                        <label>Workcenter</label>
					                        <select class="form-control" name="workcenter">
					                        	<option value="Null">-------------</option>
						                        @if(Auth::user())
						                            <option value="{{Auth::user()->workcenter}}">{{Auth::user()->workcenter}}</option>
						                        @endif
					                        </select>
					                    </div>
					                    <div class="form-group">
					                        <label>CO</label>
					                        <input class="form-control" name="CO" placeholder="Có thể nhập nhiều số CO..." />
					                    </div>
					                    <div class="form-group">
					                        <label>Nội dung*</label>
					                        <input class="form-control" type="text" name="Noidung" placeholder="Nhập nội dung cần phản hồi">
					                    </div>
					                    
					                    <button type="submit" class="btn btn-default">Thêm</button>
					                    <button type="reset" class="btn btn-default">Làm mới</button>
					                </form>
					                <!-- END RECORD KHIẾM KHUYẾT -->
					                @else
					                	Đăng nhập để record lỗi
					                @endif



							    </div>
						    </div>
						</div>
				    	<!-- end form -->
				    	
				  	</div>
				</div>
            </div>
            <!-- End Báo lỗi -->
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