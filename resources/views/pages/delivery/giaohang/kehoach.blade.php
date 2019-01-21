@extends('layout.index')
@section('css')
    <link href="admin_asset/assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="admin_asset/assets/node_modules/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="admin_asset/assets/node_modules/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="admin_asset/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="admin_asset/assets/node_modules/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="admin_asset/assets/node_modules/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection
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
            <form action="delivery/giaohang/kehoach" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                
                <input  type="date"  class="form-control " name="DateFind" value="{{ date('Y-m-d',strtotime( $today->addDay() )) }}" style="display: inline;width: 15%">

                <input  type="date" class="form-control" name="DateFind2" value="{{ date('Y-m-d',strtotime( $today )) }}" style="display: inline;width: 15%">
                
                <button type="submit" class="btn btn-default">Tìm kiếm</button>
                @if(isset($ngay))
                <h4>Ngày <span style="color: blue">{{date('d-m-Y',strtotime($ngay))}}</span> đến <span style="color: blue">{{date('d-m-Y',strtotime($ngay2))}}</span> </h4>
                @endif

                <hr>
            </form>
            <div class="table-responsive m-t-40">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Thời gian</th>
                            <th>Dự án</th>
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
                                    
                                    @endif
                                @endif
                            </td>
                            <td>{{ $ttx->giaohangboi }}</td>
                            <td>
                                @if($ttx->thoigianbatdauchathang != NULL)
                                    {{date('H:i',strtotime($ttx->thoigianbatdauchathang))}}
                                @else
                                    @if($ttx->status != 70)
                                    
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($ttx->thoigianketthucchathang != NULL)
                                    {{date('H:i',strtotime($ttx->thoigianketthucchathang))}}
                                @else
                                    @if($ttx->status >= 50 & $ttx->status != 70)
                                    
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($ttx->thoigianbagiaoDN != NULL)
                                    {{date('H:i',strtotime($ttx->thoigianbagiaoDN))}}
                                @else
                                    @if($ttx->status >= 60 & $ttx->status != 70)
                                    
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
<!-- ============================================================== -->
    <!-- Plugins for this page -->
    <!-- ============================================================== -->
    <!-- Plugin JavaScript -->
    <script src="admin_asset/assets/node_modules/moment/moment.js"></script>
    <script src="admin_asset/assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="admin_asset/assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="admin_asset/assets/node_modules/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="admin_asset/assets/node_modules/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="admin_asset/assets/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="admin_asset/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="admin_asset/assets/node_modules/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="admin_asset/assets/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script>
    // MAterial Date picker    
    $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
    $('#timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
    $('#date-format').bootstrapMaterialDatePicker({ format: 'dddd DD MMMM YYYY - HH:mm' });

    $('#min-date').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY HH:mm', minDate: new Date() });
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });
    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'DD/MM/YYYY',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
    </script>
@endsection