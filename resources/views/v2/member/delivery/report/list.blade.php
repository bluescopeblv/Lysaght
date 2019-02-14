@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
#myTable{
    font-family: "Arial";
    color: black;
    font-size: 12px;
}

myTable.tbody{
    color: black;
    font-size: 10px;
}

.tieude{
    font-family: "Arial";
    color: blue;
    font-size: 20px;
    font-style: bold;
}
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-body">
                <span class="tieude">LOGISTIC - REPORT</span>
                <span style="float:right; display: block;">
                    
                <a href="delivery2/logistic/add">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Tạo kế hoạch mới </button></a></span>
            </div>
        </div>
    </div>
</div>

<!-- /row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0"></h3>
                <!--  <p class="text-muted m-b-30">Data table example</p>-->            
                <div class="table-responsive">
                    <form action="delivery2/report" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        
                        <input  type="date" id="myDate" class="form-control" name="DateFind" value="{{ date('Y-m-d',strtotime( $today )) }}" style="display: inline;width: 20%">
                        <input  type="date" class="form-control" name="DateFind2" value="{{ date('Y-m-d',strtotime( $today )) }}" style="display: inline;width: 20%">
                        
                        <button type="submit" class="btn btn-default">Tìm kiếm</button>
                        @if(isset($ngay))
                        <h4>Ngày <span style="color: blue">{{date('d-m-Y',strtotime($ngay))}}</span> đến <span style="color: blue">{{date('d-m-Y',strtotime($ngay2))}}</span> </h4>
                        @endif

                        <hr>
                    </form>

                <table id="myTable" class="table table-bordered table-striped color-bordered-table info-bordered-table hover-table">
                    <thead>
                        <tr>
                            <th>Kế hoạch</th>
                            <th>Dự án</th>
                            <th>Giao hàng bởi</th>
                            <th>Type</th>
                            <th>Biển số xe</th>
                            <th>Tên tài xế</th>
                            <th>Nhà xe</th>
                            <th>Tải trọng xe</th>
                            <th>Chiều dài</th>
                            <!--  -->
                            
                            <th>T/G chờ chất hàng (h)</th>
                            <th>T/G chất hàng (h)</th>
                            <th>T/G chờ DN (h)</th>
                            <th>T/G chờ DO/ PXK (h)</th>
                            <th>T/G chờ bàn giao DN (h)</th>
                            <th><b>Tổng thời gian (h)</b></th>
                            <th>Status</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($thongtinxe as $ttx)
                        <tr>
                            <td>{{date('d-m',strtotime($ttx->thoigiankehoach))}}</td>
                            <td>{{ $ttx->khachhang }}</td>
                            <td>{{ $ttx->giaohangboi }}</td>
                            <td>{{ $ttx->loaihang }}</td>
                            <td>{{ $ttx->bienso }}</td>
                            <td>{{$ttx->tentaixe}}</td>
                            <td>{{$ttx->nhaxe}}</td>
                            <td>{{$ttx->taitrongxe}}</td>
                            <td>{{$ttx->chieudaixe}}</td>
                            <!--  -->
                            
                            <td>
                                {{ get_Delivery_ThoiGian_ChoChatHang($ttx->thoigianxevao,$ttx->thoigianbatdauchathang) }}
                            </td>
                            <td>
                                {{ get_Delivery_ThoiGian_ChatHang($ttx->thoigianbatdauchathang,$ttx->thoigianketthucchathang) }}
                            </td>
                            <td>
                                {{ get_Delivery_ThoiGian_ChoDN($ttx->thoigianketthucchathang, $ttx->thoigianxongDN) }}
                            </td>
                            <td>
                                {{ get_Delivery_ThoiGian_ChoDO_PXK($ttx->thoigianketthucchathang,$ttx->thoigianxongPXK) }}
                            </td>
                            <td>
                                {{ get_Delivery_ThoiGian_BanGiaoDN($ttx->thoigianketthucchathang,$ttx->thoigianxongDN, $ttx->thoigianbagiaoDN) }}
                            </td>

                            <td>
                                {{ get_Delivery_TongThoiGian($ttx->thoigianxevao,$ttx->thoigianbatdauchathang, $ttx->thoigianketthucchathang, $ttx->thoigianxongDN, $ttx->thoigianxongPXK, $ttx->thoigianbagiaoDN ) }}
                            </td>
                            
                            <td>{!! getDeliveryStatus($ttx->status) !!}</td>
                            <td>
                                <span class="label label-warning">
                                    <a href="delivery2/logistic/edit/{{$ttx->id}}"><span class="glyphicon glyphicon-edit">Sửa</span></a>
                                </span><span>  </span>

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
                "visible": true,
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