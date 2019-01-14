@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
#myTable{
    font-family: "Arial";
    color: black;
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
                <span class="tieude">LOGISTIC - QUẢN LÍ GIAO HÀNG</span>
                <span style="float:right; display: block">
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
            <h4 class="card-title">Data Table</h4>
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}           
                </div>
            @endif
            <div class="table-responsive m-t-40">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Thời gian đến</th>
                            <th>Thời gian ra</th>
                            <th>Dự án</th>
                            <th>Biển số xe</th>
                            <th>Tên tài xế</th>
                            <th>Nhà xe</th>
                            <th>Tải trọng xe</th>
                            <th>Chiều dài</th>
                            <th>Status</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($thongtinxe as $ttx)
                        <tr>
                            <td>
                                @if($ttx->thoigianxevao != NULL)
                                    {{date('d-m-Y H:i',strtotime($ttx->thoigianxevao))}}
                                @else
                                    @if($ttx->status <= 20)
                                    <span class="label label-info"><a href="delivery/baove/in/{{$ttx->id}}">Xe vào ?</a></span>
                                    @endif
                                @endif

                            </td>
                            <td>
                                @if($ttx->thoigianxera != NULL)
                                    {{date('d-m-Y H:i',strtotime($ttx->thoigianxera))}}
                                @else
                                    @if($ttx->status >= 80)
                                    <span class="label label-info"><a href="delivery/baove/out/{{$ttx->id}}">Xe ra ?</a></span>
                                    @endif
                                @endif
                            </td>
                            <td>{{$ttx->khachhang}}</td>
                            <td>{{$ttx->bienso}}</td>
                            <td>{{$ttx->tentaixe}}</td>
                            <td>{{$ttx->nhaxe}}</td>
                            <td>{{$ttx->taitrongxe}}</td>
                            <td>{{$ttx->chieudaixe}}</td>
                            <td>
                                {!! getDeliveryStatus($ttx->status) !!}
                            </td>
                            <td>
                                @if($ttx->status <= 20 )
                                <span class="label label-warning">
                                    <a href="delivery/baove/edit/{{$ttx->id}}"><span class="glyphicon glyphicon-edit">Sửa</span></a>
                                </span><span>  </span>
                                
                                <span class="label label-danger">
                                    <a href="delivery/baove/delete/{{$ttx->id}}"><span class="glyphicon glyphicon-remove-sign">Xóa</span></a>
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