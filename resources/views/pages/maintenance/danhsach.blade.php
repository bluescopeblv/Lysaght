@extends('layout.index')


@section('content')
    <div class="container">

    	<!-- Maintenance Info -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>

            <!-- THÔNG TIN BẢO TRÌ -->
            @if(Auth::user())
				@if(Auth::user())
		            <div class="col-md-12">

		                <div class="panel panel-primary ">
						  	<div class="panel-heading">MAINTENANCE | THÔNG TIN BẢO TRÌ </div>
						  	<div class="panel-body">
						  		<h3 style="color: blue">Cập nhật thông tin các chỉ số bảo trì </h3>
						    	<!-- Thông báo -->
						    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				                    <thead>
				                        <tr align="center">
				                      
				                            <th>Số vụ hư hỏng</th>
				                            <th>Thời gian/vụ</th>
				                            <th>Tỉ lệ bảo dưỡng định kì</th>
				                            <th>Thời gian cập nhật</th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                        @foreach($chiso as $cs)
				                        <tr class="odd gradeX" align="center">
				                            			              
				                            <td style="color:@if($cs->sovuhuhong < 80) green
				                            @else red @endif"> {{$cs->sovuhuhong}} trường hợp</td>
				                            <td style="color:@if($cs->thoigianpervu < 2.5) green
				                            @else red @endif"> {{$cs->thoigianpervu}} giờ/trường hợp</td>
				                            <td style="color:@if($cs->preventive > 97) green
				                            @else red @endif"> {{$cs->preventive}} %</td>
				                            <td>{{date('d-M-Y',strtotime($cs->updated_at))}} </td>
				                        </tr>
				                        @endforeach
				                    </tbody>
				                </table> <!-- End Thông báo -->
				            
				                <hr>
				                <h3 style="color: blue">Danh sách các máy chưa báo cáo bảo trì trên hệ thống M3 </h3>
				                <!-- Thông báo -->
						    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				                    <thead>
				                        <tr align="center">
				                            <th>STT</th>
				                            <th>Code</th>
				                            <th>Tên máy</th>
				                            <th>Báo cáo bảo trì</th>
				                            <th>Ghi chú</th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                        @foreach($cacmay as $cm)
				                        <tr class="odd gradeX" align="center">
				                            <td>{{$cm->id}}</td>
				                            <td>{{$cm->code}}</td>	
				                            <td>{{$cm->machine}}</td>		              
				                            <td>
				                            	@if($cm->reportM3 == 1)
					                            	<div class="dabaocao">
					                            	<span class="glyphicon glyphicon-ok" style="font-size: 18;padding-right: 5px"> </span>Đã báo cáo
					                            	</div>
				                            	@else
				                            		<div class="chuabaocao">
					                            	<span class="glyphicon glyphicon-remove" style="font-size: 18;padding-right: 5px"> </span>Chưa báo cáo
					                            	</div>

				                            	@endif</td>
				                            <td>{{$cm->note}}</td>
				                            
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
        <!-- end Maintenance Info -->

        <!-- Maintenance Function -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>

            <!-- THÔNG TIN BẢO TRÌ -->
            @if(Auth::user())
				@if(Auth::user()->quyen_baotri >= 1)
		            <div class="col-md-12">

		                <div class="panel panel-primary ">
						  	<div class="panel-heading">MAINTENANCE | CHỨC NĂNG</div>
						  	<div class="panel-body">
						  		<div class="phuc_button"><a href="maint_quanlychiphi" style="color: white">Quản lí chi phí</a></div>

				            
				              
						  	</div>
						</div>
		            </div>
		        @else
					<h4 style="color: green;text-align: center;" ></h4>
				@endif
			@else
				<h4 style="color: blue;text-align: center;" ></h4>
		  	@endif
            <!-- End THÔNG TIN BẢO TRÌ -->
            <div class="col-md-2">
            </div>
        </div>
        <!-- End Maintenance Function -->
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