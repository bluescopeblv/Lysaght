@extends('layout.index')

@section('content')
<div class="container">
	<div class="row page-titles">
        <div class="col-md-2 align-self-center">
            <h4 class="text-themecolor">GIAO HÀNG</h4>
        </div>
        <div class="col-md-10 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Data</li>
                    <a href="delivery/giaohang/kehoach"><div class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Xem kế hoạch </div></a>

                <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i><a href="delivery/giaohang/"> Danh sách</a> </button>

                </ol>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}           
                </div>
            @endif
            <div class="table-responsive m-t-40">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Dự án</th>
                            <th>Kế hoạch</th>
                            <th>Biển số</th>
                            <th>Số CO</th>
                            <th>Thời gian huấn luyện tài xế</th>
                            <th>Giao hàng bởi</th>
                            <th>Thời gian bắt đầu chất hàng</th>
                            <th>Thời gian chất hàng xong</th>
                            <th>Thời gian bàn giao DN, DO</th>
                            <th>Sản phẩm</th>
                            <th>Số tấn</th>
                            <th>Số kiện</th>
                            <th>Status</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($thongtinxe as $ttx)
                        <tr>
                            <td>{{date('d-m',strtotime($ttx->thoigiankehoach))}}</td>
                            <td><a href="delivery/giaohang/detail/{{$ttx->id}}">{{ $ttx->khachhang }}</a></td>
                            <td>{{ $ttx->bienso }}</td>
                            <td> <a href="delivery/giaohang/detail/{{$ttx->id}}">{{ getSoLuongCO($ttx->id) }}</a> </td>
                            <td>
                                @if($ttx->thoigianhuanluyen != NULL)
                                    {{date('H:i',strtotime($ttx->thoigianhuanluyen))}}
                                @else
                                    @if($ttx->status != 70)
                                    <span class="label label-info"><a href="delivery/giaohang/hltaixe/{{$ttx->id}}">HL xong?</a></span>
                                    @endif
                                @endif
                            </td>
                            <td>{{ $ttx->giaohangboi }}</td>
                            <td>
                                @if($ttx->thoigianbatdauchathang != NULL)
                                    {{date('H:i',strtotime($ttx->thoigianbatdauchathang))}}
                                @else
                                    @if($ttx->status != 70)
                                    <span class="label label-info"><a href="delivery/giaohang/bdchathang/{{$ttx->id}}">Chất hàng ?</a></span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($ttx->thoigianketthucchathang != NULL)
                                    {{date('H:i',strtotime($ttx->thoigianketthucchathang))}}
                                @else
                                    @if($ttx->status >= 50 & $ttx->status != 70)
                                    <span class="label label-info"><a href="delivery/giaohang/ktchathang/{{$ttx->id}}">Đã xong ?</a></span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($ttx->thoigianbagiaoDN != NULL)
                                    {{date('H:i',strtotime($ttx->thoigianbagiaoDN))}}
                                @else
                                    @if($ttx->status >= 60 & $ttx->status != 70)
                                    <span class="label label-info"><a href="delivery/giaohang/bangiaodn/{{$ttx->id}}">Bàn giao DN ?</a></span>
                                    @endif
                                @endif
                            </td>
                            <td>{{ $ttx->sanpham }}</td>
                            <td>{{ $ttx->khoiluong }}</td>
                            <td>{{ $ttx->sokien }}</td>
                            <td>
                                {!! getDeliveryStatus($ttx->status) !!}
                            </td>
                            
                            <td>
                                @if($ttx->status != 70)
                            	<span class="label label-warning">
                            		<a href="delivery/giaohang/edit/{{$ttx->id}}"><span class="glyphicon glyphicon-edit">Sửa</span></a>
                            	</span>
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
@endsection

@section('script')
<script>
  	$(document).ready(function() {
	    $('#myTable').DataTable();
	    $(document).ready(function() {
	        var table = $('#example').DataTable({
	            "columnDefs": [{
	                "visible": false,
	                "targets": 2
	            }],
	            "order": [
	                [2, 'asc']
	            ],
	            "displayLength": 25,
	            "drawCallback": function(settings) {
	                var api = this.api();
	                var rows = api.rows({
	                    page: 'current'
	                }).nodes();
	                var last = null;
	                api.column(2, {
	                    page: 'current'
	                }).data().each(function(group, i) {
	                    if (last !== group) {
	                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
	                        last = group;
	                    }
	                });
	            }
	        });
	        // Order by the grouping
	        $('#example tbody').on('click', 'tr.group', function() {
	            var currentOrder = table.order()[0];
	            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
	                table.order([2, 'desc']).draw();
	            } else {
	                table.order([2, 'asc']).draw();
	            }
	        });
	    });
	});
</script>
@endsection