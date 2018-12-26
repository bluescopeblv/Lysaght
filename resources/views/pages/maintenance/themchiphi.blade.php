@extends('layout.index')

@section('content')
    <div class="container">
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>
            <!-- Maintenance Record Them moi -->
	    	<div class="col-md-12">
		    	<div class="panel panel-primary">
				    <div class="panel-heading">MAINTENACE | <a href="maint_quanlychiphi">DANH SÁCH CHI PHÍ</a> | THÊM</div>
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
				    	<form action="maint_quanlychiphi/them" enctype="multipart/form-data" method="post">
		                    <input type="hidden" name="_token" value="{{csrf_token()}}">
		                <div class="row p-t-20">
		              		<div class="col-md-4">
			                    <div class="form-group">
			                        <label>Tên hàng</label>
			                        <input class="form-control" name="tenhang" placeholder="Tên hàng chi tiết..." />
			                    </div>
			                </div>
			                <div class="col-md-4">
			                    <div class="form-group">
			                        <label>Item No</label>
			                        <input class="form-control" type="text" name="itemNo" placeholder="Item number">
			                    </div>
			                </div>
			                <div class="col-md-4">
			                    <div class="form-group">
			                        <label>PO No</label>
			                        <input class="form-control" type="text" name="PoNo" placeholder="PO number">
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group">
			                        <label>Số hóa đơn</label>
			                        <input class="form-control" type="text" name="HDNo" placeholder="Số hóa đơn">
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group">
			                        <label>Supplier</label>
			                        <input class="form-control" type="text" name="supplier" placeholder="Supplier - Nhà cung cấp">
			                    </div>
			                </div>
		                    <div class="col-md-3">
			                    <div class="form-group">
			                        <label>Đơn vị tính</label>
			                        <select class="form-control" type="text" name="donvitinh" placeholder="Đơn vị tính">
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
			                        <input class="form-control" type="text" name="soluongnhap" placeholder="Số lượng nhập">
			                    </div>
			                </div>
			                <div class="col-md-4">
			                    <div class="form-group">
			                        <label>Đơn giá</label>
			                        <input class="form-control" type="text" name="dongia" placeholder="Đơn giá">
			                    </div>
			                </div>
			                <div class="col-md-4">
				                <div class="form-group">
			                        <label>Khu vực</label>
			                        <input class="form-control" type="text" name="khuvuc" placeholder="khu vực">
			                    </div>
			                </div>
			                <div class="col-md-4">
			                    <div class="form-group">
			                        <label>Ghi chú</label>
			                        <input class="form-control" type="text" name="note" placeholder="ghi chú">
			                    </div>
			                </div>
			                <div class="col-md-6">
			                    <div class="form-group">
			                        <label>File chứng từ</label>
			                        <input type="file" name="fileChungtu">
			                    </div>
			                </div>
			                </div>
		                    <button type="submit" class="btn btn-default">Thêm</button>
		                
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

@section('script')
  <script>
	   
  </script>
@endsection