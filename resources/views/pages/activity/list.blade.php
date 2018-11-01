@extends('layout.index')


@section('content')
    <div class="container">

    	<!-- Maintenance Info -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>
		            <div class="col-md-12">

		                <div class="panel panel-primary ">
						  	<div class="panel-heading">ACTIVITY | HOẠT ĐỘNG </div>
						  	<div class="panel-body">
						  		<h3>Các sự kiện diễn ra</h3>
						    	<!-- Thông báo -->
						    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				                    <thead>
				                        <tr align="center">
				                      
				                            <th>Thời gian</th>
				                            <th>Tên sự kiện</th>
				                            <th>Deadline</th>
				                            <th>Số người đã đăng kí</th>
				                            <th>Đăng kí</th>
				                            
				                        </tr>
				                    </thead>
				                    <tbody>
				                    	@foreach($activity as $atv)
				                    	<tr>
				                    		<td>{{date('d-M-Y', strtotime($atv->ngaybatdau))}}</td>
				                        	<td>{{$atv->name}}</td>
				                        	<td>{{date('d-M-Y H:i', strtotime($atv->deadline))}}</td>
				                        	<td style="text-align: center;">{{activityDemSoNguoiThamDu($atv->id)}}<a href="activity/registed/{{$atv->id}}">
				                        		 >>  Xem chi tiết
				                        	</a></td>
				                        	<td>
				                        		@if($today <= $atv->deadline)
				                        			<a href="activity/register/{{$atv->id}}" style="color: green">Đăng kí</a>
				                        			
				                        		@else
				                        			<span style="color: red">
				                        				Hết hạn đăng kí
				                        			</span>
				                        		@endif
				                        	</td>
				                        </tr>
				                        @endforeach
				                    </tbody>
				                </table> <!-- End Thông báo -->
				                
						  	</div>
						</div>
		            </div>
		    
            <div class="col-md-2">
            </div>
        </div>
        <!-- end Maintenance Info -->

        <!-- Maintenance Function -->
    	
        <!-- End Maintenance Function -->
    </div>

@endsection

@section('content')
	<script>
		    
	</script>
@endsection