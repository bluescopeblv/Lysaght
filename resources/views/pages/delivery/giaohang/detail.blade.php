@extends('layout.index')

@section('content')
<div class="container">
	<div class="row page-titles">
        <div class="col-md-3 align-self-center">
            <h4 class="text-themecolor" style="color: red">CHI TIẾT GIAO HÀNG</h4>
        </div>
        <div class="col-md-9 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    Dự án: <span style="color: blue">{{ $thongtinxe->khachhang }}</span> |
                    Nhà xe:<span style="color: blue">{{ $thongtinxe->nhaxe }}</span> | 
                    
                    <a href="delivery/giaohang">Quay lại</a>  
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-8">
    		<!-- Column -->
            <div class="col-md-6 col-lg-8 col-xlg-2">
                <div class="card">
                    <div class="box bg-info text-center">
                        <h3 class="font-medium text-blue">{{ $thongtinxe->khachhang }}</h3>
                        <h6 class="text-yellow">Dự án</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-2">
                <div class="card">
                    <div class="box bg-info text-center">
                        <h3 class="font-small text-blue">{{ $thongtinxe->bienso }}</h3>
                        <h6 class="text-yellow">Biển số xe</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3 col-xlg-2">
                <div class="card">
                    <div class="box bg-info text-center">
                        <h3 class="font-small text-blue">{{ $thongtinxe->taitrongxe }}</h3>
                        <h6 class="text-yellow">Khối lượng xe (Tấn)</h6>
                    </div>
                </div>
            </div>
            
            <!-- Column -->
            <div class="col-md-6 col-lg-3 col-xlg-2">
                <div class="card">
                    <div class="box bg-info text-center">
                        <h3 class="font-small text-blue">{{ $thongtinxe->chieudaixe }}</h3>
                        <h6 class="text-yellow">Chiều dài xe (m)</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3 col-xlg-2">
                <div class="card">
                    <div class="box bg-info text-center">
                        <h3 class="font-small text-blue">{{ $thongtinxe->giaohangboi }}</h3>
                        <h6 class="text-yellow">Giao hàng bởi</h6>
                    </div>
                </div>
            </div>
        
        </div>
        <div class="col-lg-4">
            <div class="card">
	        <div class="card-body">
	            <h4 class="card-title">Thông tin chi tiết CO</h4>
	            <div class="panel panel-primary">
	            	<div class="table-responsive m-t-40">
		                <table id="myTable" class="table table-bordered table-striped">
		                    <thead>
		                        <tr>	                            
		                            <th>CO</th>
		                            <th>Chi tiết</th>	                            
		                            <th>Status</th>	                            
		                        </tr>
		                    </thead>
		                    <tbody>
		                        @foreach($CO as $key => $val)
		                        <tr>	                           
		                            <td>{{$val->CO}}</td>
		                            <td>{{$val->chitietgiaohang}}</td>
		                            <td>
		                                @if($thongtinxe->status == 20 )
		                                    <span class="label label-info">Xe vào</span>
		                                @elseif($thongtinxe->status == 30)
		                                    <span class="label label-warning">CHỜ</span>
		                                @elseif($thongtinxe->status == 40)
		                                    <span class="label label-success">OK</span>
		                                @elseif($thongtinxe->status == 50)
		                                    <span class="label label-success">Đang chất hàng</span>
		                                @elseif($thongtinxe->status == 60)
		                                    <span class="label label-success">Chất hàng xong</span>
		                                @elseif($thongtinxe->status == 80)
		                                    <span class="label label-success">Xong thủ tục</span>
		                                @elseif($thongtinxe->status == 90)
		                                    <span class="label label-danger">Xe đã ra</span>
		                                @else
		                                    <span class="label label-danger">NO DEFINE</span>
		                                @endif
		                            </td>                           
		                        </tr>
		                        @endforeach
		                    </tbody>
		                </table>
		            </div>
	            </div>	            
	        </div>
    		</div>
        </div>
        
    </div>
    <!-- Row -->
    <div class="row">

        <div class="col-12">
            <div class="row">
                <!-- column -->
                @foreach($pictures as $picture)
                <div class="col-lg-3 col-md-6">
                    <!-- Card -->
                    <div class="card">
                        <img class="card-img-top img-responsive" src="upload/delivery/done/{{$picture->link_hinh}}" alt="Card image cap">
                    </div>
                    <a href="delivery/giaohang/detail/{{$thongtinxe->id}}/delete/{{$picture->id}}" class="btn btn-danger"> Xóa </a>
                    <a class="btn btn-info"> {{ $thongtinxe->khachhang }} </a>
                    
                </div>
                @endforeach
            </div>
            <!-- Row -->
        </div>
    </div>

    <div class="col-md-12">
        <hr>
        <form action="delivery/giaohang/detail/{{$thongtinxe->id}}/add" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <label>Thêm ảnh giao hàng</label>
                <input type="file" name="link_hinh">
            </div>
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Thêm ảnh</button>
        </form>
    </div>

</div>
@endsection

@section('script')


@endsection