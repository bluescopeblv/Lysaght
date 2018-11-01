@extends('layout.index')

@section('content')
	<style>
		.current { color: red; font-weight: bold; }

		.detail_CO {font-size: 20px; color: yellow }
	</style>

    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>
            
            <div class="col-md-20">
                <div class="panel panel-info">
				  	<div class="panel-heading">CHI TIẾT ID:  {{$baoloi->id}} </div>
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
				  		<!-- REPORT KHIẾM KHUYẾT -->
					    	<form action="baoloi-sua/{{$baoloi->id}}" method="post">
			                    <input type="hidden" name="_token" value="{{csrf_token()}}">
			                    <div class="col-md-4">
				                    <div class="form-group">
				                        <label>Workcenter</label>
				                        <input class="form-control" type="text" name="workcenter" value="{{$baoloi->workcenter}}" disabled/>
				                    </div>
				                </div>
				                <div class="col-md-4">
				                    <div class="form-group">
				                        <label>Tên người báo lỗi</label>
				                        <input class="form-control" name="name" value="{{$baoloi->name}}" disabled />
				                    </div>
				                </div>
				                <div class="col-md-4">
				                    <div class="form-group">
				                        <label>CO</label>
				                        <input class="form-control" name="CO" value="{{$baoloi->CO}}" disabled />
				                    </div>
				                </div>
				                <div class="col-md-8">
				                    <div class="form-group">
				                        <label>Nội dung lỗi</label>
				                        <input class="form-control" name="content" value="{{$baoloi->Noidung}}" disabled />
				                    </div>
				                </div>
				                <div class="col-md-4">
				                    <div class="form-group">
				                        <label>Người chịu trách nhiệm*</label>
				                        <input class="form-control" name="nguoichiutrachnhiem" placeholder="Nhập tên người chịu trách nhiệm, giải quyết" value="{{Auth::user()->name}}" />
				                    </div>
				                </div>
				                <div class="col-md-8">
				                    <div class="form-group">
				                        <label>Giải quyết khắc phục*</label>
				                        <input class="form-control" name="ppkhacphuc" placeholder="Phương pháp khắc phục..." />
				                    </div>
				                </div>
				                <div class="col-md-4">
				                    <div class="form-group">
				                        <label>Update Status*</label>
				                        <select class="form-control" name="status">   
				                        	<option style="font-size: 16px; color:blue" value="1">Done</option>
					                        <option style="font-size: 16px; color:blue" value="0">Đang thực hiện</option>
				                        </select>
				                    </div>
				                </div>
				                <div class="col-md-12">
				                    <div class="form-group">
				                        <label>Notes</label>
				                        <input class="form-control" name="notes" placeholder="Nhập note nếu có..." />
				                    </div>
			                    </div>

			                    <button type="submit" class="btn btn-default">Gửi</button>
			                    <button type="reset" class="btn btn-default">Làm mới</button>
			                </form>
		                <!-- END REPORT KHIẾM KHUYẾT -->
				    	
				  	</div>

				</div>
            </div>


            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>

@endsection

@section('script')
	<script>
		$(document).ready(function() {
			//alert("Dã chạy");
			$('#dataTables-example tr.odd ').click(function(){
		        $('tr').removeClass();
		        $(this).addClass('current');

		        //var id = $('#id').find('td:nth-child(1)').text();
		        var id = $(this).find(".id").html();
		        //alert(id);
		        
		        $.get("chitiet/"+id,function(data) {
			 		$("#table_details").html(data);
			 	});

			 	
		    });

		    $('#reportXong').click(function(){
			    $.get("reportXong/"+id,function() {
				 		
				 });
			});

			$('#checkbox').click(function (e) {
			    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
			});
		});

	</script>
@endsection