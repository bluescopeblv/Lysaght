@extends('layout.index')

@section('content')
    <div class="container">
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>
            <!-- Maintenance Record Them moi -->
	    	<div class="col-md-12">
		    	<div class="panel panel-primary">
				    <div class="panel-heading">MAINTENACE | <a href="maint_quanlychiphi">DANH SÁCH CHI PHÍ</a> | SỬA </div>
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
                        
                        @if(Auth::user())
                        <!-- RECORD CHI PHÍ -->
				    	<form action="maint_quanlychiphi/sua/{{$chiphi->id}}" enctype="multipart/form-data" method="post">
		                    <input type="hidden" name="_token" value="{{csrf_token()}}">
		                <div class="row p-t-20">
		                	<div class="col-md-2">
			              		<div class="form-group">
			                        <label>Ngày nhập</label>
			                        <input class="form-control" name="ngaynhap" placeholder="Ngày nhập..." value="{{$chiphi->ngaynhap}}" />
			                    </div>
			                </div>
			                <div class="col-md-5">
			                    <div class="form-group">
			                        <label>Tên hàng</label>
			                        <input class="form-control" name="tenhang" placeholder="Tên hàng chi tiết..." value="{{$chiphi->tenhang}}" />
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group">
			                        <label>Item No</label>
			                        <input class="form-control" type="text" name="itemNo" placeholder="Item number" value="{{$chiphi->itemNo}}">
			                    </div>
			                </div>
			                <div class="col-md-2">
			                    <div class="form-group">
			                        <label>PO No</label>
			                        <input class="form-control" type="text" name="PoNo" placeholder="PO number" value="{{$chiphi->PoNo}}">
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group">
			                        <label>Số hóa đơn</label>
			                        <input class="form-control" type="text" name="HDNo" placeholder="Số hóa đơn" value="{{$chiphi->HDNo}}">
			                    </div>
			                </div>
			                <div class="col-md-4">
			                    <div class="form-group">
			                        <label>Supplier</label>
			                        <input class="form-control" type="text" name="supplier" placeholder="Supplier - Nhà cung cấp" value="{{$chiphi->supplier}}">
			                    </div>
			                </div>
			                <div class="col-md-2">
			                    <div class="form-group">
			                        <label>Đơn vị tính</label>
			                        <select class="form-control" type="text" name="donvitinh" placeholder="Đơn vị tính">
			                        		<option value="{{$chiphi->donvitinh}}">{{$chiphi->donvitinh}}</option>
			                        		<option value="Cái">Cái</option>
			                        		<option value="Bộ">Bộ</option>
			                        		<option value="Lần">Lần</option>
			                        		<option value="Máy">Máy</option>
			                        		<option value="Lít">Lít</option>
			                        		<option value="Lot">Lot</option>
			                        		<option value="Set">Set</option>
			                        		<option value="EA">EA</option>
			                       	</select>
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group">
			                        <label>Số lượng nhập</label>
			                        <input class="form-control" type="text" name="soluongnhap" placeholder="Số lượng nhập"  value="{{$chiphi->soluongnhap}}">
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group">
			                        <label>Đơn giá</label>
			                        <input class="form-control" type="text" name="dongia" placeholder="Đơn giá" value="{{$chiphi->dongia}}">
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group">
			                        <label>Khu vực</label>
			                        <input class="form-control" type="text" name="khuvuc" placeholder="khu vực" value="{{$chiphi->khuvuc}}">
			                    </div>
		                	</div>
		                    <div class="col-md-3">
			                    <div class="form-group">
			                        <label>Ngày giao</label>
			                        <input class="form-control" name="ngaygiao" placeholder="Ngày giao..." value="{{$chiphi->ngaygiao}}" />
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group">
			                        <label>Ghi chú</label>
			                        <input class="form-control" type="text" name="note" placeholder="ghi chú" value="{{$chiphi->note}}">
			                    </div>
			                </div>
		                    <div class="form-group">
		                        <input class="form-control" type="hidden" name="fileNameCu" value="{{$chiphi->tenchungtu}}">
		                    </div>
		                </div>
		                    <div class="form-group">
		                        <label>File chứng từ: 
		                        	@if($chiphi->tenchungtu)
		                        		<a href="upload/maintenance/chungtu/{{$chiphi->tenchungtu}}">Đã có file: {{substr($chiphi->tenchungtu,0,strlen($chiphi->tenchungtu)-19).substr($chiphi->tenchungtu,strlen($chiphi->tenchungtu)-4,4)}}</a>
		                        	@else
		                        		
		                        	@endif
		                        	<!-- //strlen($chiphi->tenchungtu) - 12 -->
		                        </label>
		                        <input type="file" name="fileChungtu">
		                    </div>
		                    <button type="submit" class="btn btn-default">Sửa</button>
		                    
		                </form>
		                <!-- END RECORD CHI PHÍ -->
		                @else
		                	Đăng nhập để record lỗi
		                @endif



				    </div>
			    </div>
			</div>
	    	<!-- Maintenance Record Them moi -->
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