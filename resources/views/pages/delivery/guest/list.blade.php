@extends('layout.index')

@section('content')
<div class="container">
	<div class="row page-titles">
        <div class="col-md-2 align-self-center">
            <h4 class="text-themecolor">GUEST</h4>
        </div>
        <div class="col-md-10 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Hôm nay {{ date('d-M-Y')}}</a></li>
                    
                        <li class="breadcrumb-item active"><a href="delivery">Quay lại</a></li>
                <a href="delivery/guest/kehoach">
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Xem lịch sử </button>
                </a>
                <a href="delivery/guest/kehoach">
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Xem kế hoạch </button>
                </a>

                </ol>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <h4 class="card-title"></h4>
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
                        <th>Biển số</th>
                        <th>Giao hàng bởi</th>
                        <th>Type</th>
                        <th>Thời gian confirm</th>
                        <th>Thời gian Kế hoạch</th>
                        <th>Thời gian Thanh toán</th>
                        <th>Thời gian xong DN/DO</th>
                        <th>Thời gian PXK</th>
                        <th>Số CO</th>
                        <th>Số ảnh đã chụp</th>
                        <th>Status</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                	
                	@foreach($thongtinxe as $ttx)
                    <tr>
                        <td>{{ $ttx->khachhang }}</td>
                        <td>{{ $ttx->bienso }}</td>
                        <td>{{ $ttx->giaohangboi }}</td>
                        <td>{{ $ttx->loaihang }}</td>
                        <td>
                            @if($ttx->thoigianlogisticConfirm != NULL)
                                {{ date('H:i',strtotime($ttx->thoigianlogisticConfirm)) }}
                            @else
                                
                            @endif
                        </td>
                        
                        <td>
                            @if($ttx->thoigiankehoach != NULL)
                                {{ date('H:i',strtotime($ttx->thoigiankehoach)) }}
                            @else
                                
                            @endif
                        </td>
                        <td>
                            @if($ttx->thoigianthanhtoan != NULL)
                                {{ date('H:i',strtotime($ttx->thoigianthanhtoan)) }}
                            @else
                                
                            @endif
                        </td>
                        <td>
                            @if($ttx->thoigianxongDN != NULL)
                                {{ date('H:i',strtotime($ttx->thoigianxongDN)) }}
                            @else
                                
                            @endif
                        </td>
                        <td>
                            @if($ttx->thoigianxongPXK != NULL)
                                {{ date('H:i',strtotime($ttx->thoigianxongPXK)) }}
                            @else
                                
                            @endif
                        </td>
                        <td> 
                            {{ getSoLuongCO($ttx->id) }} 
                        </td>
                        <td>
                            {{ getDeliverySoAnh($ttx->id) }}
                        </td>
                        <td>
                            {!! getDeliveryStatus($ttx->status) !!}
                        </td>
                        
                        <td>
                            @if($ttx->status != 70)
                        	<span class="label label-warning">
                        		<a href="delivery/guest/view/{{$ttx->id}}"><span class="glyphicon glyphicon-edit">Detail..</span></a>
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