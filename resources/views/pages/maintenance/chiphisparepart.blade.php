@extends('layout.index')


@section('content')
    <div class="container">

    	<!-- Report chi phi sparepart -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>

            <!-- THÔNG TIN BẢO TRÌ -->
            @if(Auth::user())
				@if(Auth::user())
		            <div class="col-md-12">

		                <div class="panel panel-primary ">
						  	<div class="panel-heading">MAINTENANCE | CHI PHÍ | <a href="maintenance/thongke">Thống kê</a></div>
						  	<div class="panel-body">
						        <h3 style="color: blue">Danh sách chi phí bảo trì |
						        	<small><a href="maint_quanlychiphi/them" style="color: orange">Thêm mới</a></small> </h3>
				                
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
				                <!-- Thông báo -->
						    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				                    <thead>
				                        <tr align="center">
				                            <th>ID</th>
				                            <th>Ngày nhập</th>
				                            <th>Tên hàng</th>
				                            <th>Item No.</th>
				                            <th>PO No.</th>
				                            <th>HD No.</th>
				                            <th>Đơn vị</th>
				                            <th>SL nhập</th>
				                            <th>Đơn giá</th>
				                            <th>Thành tiền</th>
				                            <th>Link</th>
				                            @if(Auth::user()->quyen_baotri >= 2)
				                            	<th>User</th>
				                            @endif
				                            <th>Sửa</th>
				                            <th>Xóa</th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                        @foreach($chiphi as $cp)
				                        <tr class="odd gradeX" align="center">
				                            <td>{{$cp->id}}</td>
				                            <td>{{date('d-m-Y', strtotime($cp->ngaynhap))}}</td>	
				                            <td>{{$cp->tenhang}}</td>
				                            <td>{{$cp->itemNo}}</td>
				                            <td>{{$cp->PoNo}}</td> 
				                            <td>{{$cp->HDNo}}</td>
				                            <td>{{$cp->donvitinh}}</td>
				                            <td>{{$cp->soluongnhap}}</td>
				                            <td>{{number_format($cp->dongia)}}</td>
				                            <td>{{number_format($cp->thanhtien)}}</td>
				                            @if($cp->tenchungtu)
				                            <td><a href="upload/maintenance/chungtu/{{$cp->tenchungtu}}">Đã có</a></td>
				                            @else
				                            <td></td>
				                            @endif
				                            @if(Auth::user()->quyen_baotri >= 2)
				                            	<td>{{$cp->users->name}}</td>
				                            @endif
				                            <td><a href="maint_quanlychiphi/sua/{{$cp->id}}"><span class="glyphicon glyphicon-edit"></span> Sửa</a></td>
				                            <td><a href="maint_quanlychiphi/xoa/{{$cp->id}}"><span class="glyphicon glyphicon-remove-sign"></span> Xóa</a></td>
				                        </tr>
				                        @endforeach
				                    </tbody>
				                </table> <!-- End Thông báo -->
						  	</div>
						</div>
		            </div>
		        @else
					<h4 style="color: green;text-align: center;" > Bạn không có quyền truy cập vào module này. Để được cấp quyền vui lòng liên hệ Phúc</h4>
				@endif
			@else
				<h4 style="color: blue;text-align: center;" > Bạn vui lòng đăng nhập để xem nội dung.</h4>
		  	@endif
            <!-- End THÔNG TIN BẢO TRÌ -->
            <div class="col-md-2">
            </div>
        </div>
        <!-- End Report chi phi sparepart -->

        <!-- Report chi phi sparepart -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>

            <!-- THÔNG TIN BẢO TRÌ -->
            @if(Auth::user())
				@if(Auth::user())
		            <div class="col-md-12">
		                <div class="panel panel-success ">
						  	<div class="panel-heading">MAINTENANCE | REPORT | DANH SÁCH CHỨNG TỪ THANH TOÁN </div>
						  	<div class="panel-body">
						        <h3 style="color: blue">Chứng từ thanh toán |
						        	<small>Đây chỉ là report để chỉnh sửa vui lòng chỉnh sửa ở mục trên | </small> </h3>
				                
				               	<h5 style="color: blue">DOWNLOAD ALL<a href="export-maint-chungtuthanhtoan/xls" style="color: orange">EXCEL 2003</a> - <a style="color: orange" href="export-maint-chungtuthanhtoan/xlsx">EXCEL 2007 - 2016</a><h5>
						        
				                <!-- Thông báo -->
						    	<table class="table table-striped table-bordered table-hover" id="dataTables-example1">
				                    <thead>
				                        <tr align="center">
				                            <th>ID</th>
				                            <th>Người giao</th>                       
				                            <th>PO No.</th>
				                            <th>HD No.</th>
				                            <th>Supplier</th>
				                            <th>Nội dung chi trả</th>
				                            <th>Thành tiền</th>
				                            <th>Ngày giao</th>
				                            <th>Ghi chú</th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                        @foreach($chiphi as $cp)
				                        <tr class="odd gradeX" align="center">
				                            <td>{{$cp->id}}</td>
				                            <td>{{$cp->users->name}}</td>
				                            <td>{{$cp->PoNo}}</td> 
				                            <td>{{$cp->HDNo}}</td>
				                            <td>{{$cp->supplier}}</td>
				                            <td>{{$cp->tenhang}}</td>
				                            <td>{{number_format($cp->thanhtien)}}</td>
				                            <td>{{date('d-m-Y', strtotime($cp->ngaygiao))}}</td>
				                            <td>{{$cp->note}}</td>
				                        </tr>
				                        @endforeach
				                    </tbody>
				                </table> <!-- End Thông báo -->
						  	</div>
						</div>
		            </div>
		        @else
					<h4 style="color: green;text-align: center;" > Bạn không có quyền truy cập vào module này. Để được cấp quyền vui lòng liên hệ Phúc</h4>
				@endif
			@else
				<h4 style="color: blue;text-align: center;" > Bạn vui lòng đăng nhập để xem nội dung.</h4>
		  	@endif
            <!-- End THÔNG TIN BẢO TRÌ -->
            <div class="col-md-2">
            </div>
        </div>
        <!-- End Report chi phi sparepart -->
    </div>

@endsection

@section('script')

  <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });

        $('#dataTables-example1').DataTable({
            responsive: true
        });
    });
  </script>
@endsection