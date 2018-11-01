@extends('layout.index')

@section('content')
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>

            <!-- FEEDBACK -->
            <div class="col-md-12">
                <div class="panel panel-primary ">
				  	<div class="panel-heading">DANH SÁCH RECORD KHIẾM KHUYẾT 5S | DEFECT LIST | <a href="fives/thongke/">Thống kê</a></div>
				  	<div class="panel-body">
				  		<div class="row">
				  			<marquee>
				  				Quy định: Công việc hoàn thành / tổng số ticket =  Màu đỏ < 40%, Màu cam < 70%, Màu xanh >= 70%
							</marquee>

				  		</div>
				  		<!-- Dashboard -->
		               	<div class="row">
		               		@for($i = 0; $i < $arrAll['sum']; $i++)
					        <div class="col-lg-3 col-xs-6">
						        <!-- small box -->
						        <div class="small-box 

						        @if($arrAll['tong'][$i] > 0)
							        @if($arrAll['dagiaiquyet'][$i] / $arrAll['tong'][$i] >= 0.7 ) 
							        	bg-green 
							        @elseif($arrAll['dagiaiquyet'][$i] / $arrAll['tong'][$i] >= 0.4)
							        	bg-orange 
							        @else
							        	bg-red
							        @endif
							    @else
							    	bg-green
							    @endif
						        ">
						            <div class="inner">
						            	<span class="line1L">{{$arrAll['tong'][$i]}}</span>
						              	<span class="line1R">{{$arrAll['dagiaiquyet'][$i]}}</span>
						              	<br>
						              	<span class="line2L">Tổng</span>
						              	<span class="line2R">Đã giải quyết</span>
						            </div>			            
						            <a class="small-box-footer">{{$arrAll['name'][$i]}} <i class="fa fa-laugh-beam"></i></a>
						        </div>
						    </div>
						    @endfor
					    </div>
					    <!-- End Dashboard -->

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
		                            <th>Khiếm khuyết</th>
		                            <th>Thẻ số</th>
		                            <th>Loại kk</th>
		                            @if(Auth::user())
			                            @if(Auth::user()->quyen_5s >= 2)
				                            <th>Workcenter</th>
				                            <th>Complete date</th>
				                            <th>Người sửa</th>
				                            <th>Báo cáo</th>
			                            @endif
			                        @endif
		                            <th>Status</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	@if(isset($defect))
			                        @foreach($defect as $df)
			                        <tr class="odd gradeX" align="center">
			                            <td>{{$df->id}}</td>
			                            <td>{{date('d-M-Y', strtotime($df->date))}}</td>
			                            
			                            <td>{{$df->mota}}</td>
			                            <td>{{$df->theso}}</td>

			                            <td>{{ getLoaiKhiemKhuyet($df->id_loaikhiemkhuyet) }}</td>
			                            <!-- <td>{{$df->id_loaikhiemkhuyet}}</td> -->
			                            @if(Auth::user()->quyen_5s >= 2)
			                            	<td>{{$df->workcenter}}</td>
				                            <td>@if($df->ngayhoanthanh) {{date('d-M-Y', strtotime($df->ngayhoanthanh))}} @else @endif</td>
				                            <td>{{$df->nguoichiutrachnhiem}}</td>
				                            <td>
				                            	<a href="fives/chitiet/{{$df->id}}" class="btn btn-info btn-sm">
          											<span class="glyphicon glyphicon-floppy-save"></span> Report
        										</a>
				                            </td>
			                            @endif
			                            <td>@if($df->status == 1)
			                            		<span style="color: green">Done</span>
			                            	@else
			                            		 <span style="color:red">Chưa giải quyết</span>
			                            @endif</td>
			                        </tr>
			                        @endforeach
			                    @endif
		                    </tbody>
		                </table> <!-- End Thông báo -->
		                <div>@if(Session('$defect')) {{$defect->links()}} @endif </div>
		                <hr>
				    	

				    	<!-- form -->
				    	@if(Auth::user())
				    		@if(Auth::user()->quyen_5s >= 1)
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
					                        
					                        <!-- RECORD KHIẾM KHUYẾT -->
									    	<form action="fives" method="post">
							                    <input type="hidden" name="_token" value="{{csrf_token()}}">
							                    <div class="form-group">
							                        <label>Workcenter</label>
							                        <select class="form-control" name="workcenter">
								                        @if(Auth::user())
								                            <option value="{{Auth::user()->workcenter}}">{{Auth::user()->workcenter}}</option>
								                        @endif
							                        </select>
							                    </div>
							                    <div class="form-group">
							                        <label>Mô tả khiếm khuyết*</label>
							                        <input class="form-control" name="mota" placeholder="Nhập nội dung khiếm khuyết..." />
							                    </div>
							                    <div class="form-group">
							                        <label>Thẻ khiếm khuyết số</label>
							                        <select class="form-control" name="sothe" style="font-size: 18px">
								                        @for($i = 1;$i<=12;$i++)
								                            <option style="font-size: 18px; color:blue" value="<?php echo($i) ?>"><?php echo($i) ?></option>
								                        @endfor
							                        </select>
							                    </div>
							                    <div class="form-group">
							                        <label>Loại khiếm khuyết</label>
							                        <select class="form-control" name="loaikhiemkhuyet" style="">
							                        	<option style="font-size: 18px; color:blue" value="">--Chọn khiếm khuyết--</option>
								                        @foreach($loaikhiemkhuyet as $loaikk)
								                            <option style="font-size: 18px; color:blue" value="{{$loaikk->id}}">{{ $loaikk->name }}</option>
								                        @endforeach
							                        </select>
							                    </div>
							                    <div class="form-group">
							                        <label>Lặp lại không ? *</label>
							                        <label class="radio-inline">
							                            <input name="laplai" value="0" checked="" type="radio">Không
							                        </label>
							                        <label class="radio-inline">
							                            <input name="laplai" value="1" type="radio">Có
							                        </label>
							                    </div>
							                    

							                    <button type="submit" class="btn btn-success">Thêm</button>
							                    
							                </form>
							                <!-- END RECORD KHIẾM KHUYẾT -->
									    </div>
								    </div>
								</div>
							@else
								<h4 style="color: green;">Bạn không có quyền record module này. Vui lòng liên hệ Phúc khi cần thiết</h4>
							@endif
						@else
							Đăng nhập để record!
						@endif
				    	<!-- end form -->
				    	
				  	</div>
				</div>
            </div>
            <!-- End FEEDBACK -->
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>

@endsection

@section('script')
	<script>
	  	$(document).ready(function() {
	        $('#dataTables-example').DataTable({
	            responsive: true
	        });
	    });
	</script>
@endsection