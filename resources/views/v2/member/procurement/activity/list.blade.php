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
                <span class="tieude">PROCUREMENT - PRICE CHECK</span>
                <span style="float:right; display: block">
                <a href="procurement/activity/add">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> New check </button></a></span>
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
                <table id="myTable" class="table table-bordered table-striped color-bordered-table info-bordered-table hover-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Khoảng cách 2 công nhân (m)</th>
                            <th>Finishgood/day (m2)</th>
                            <th>Dầu/day (lit)</th>
                            <th>Giá gỗ</th>
                            <th>Ny lông</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($products as $key=>$val)
                        <tr>
                            <td>{{ $val->id }}</td>
                            <td>{{ $val->name }}</td>

                            <td>{{ $val->distance_2_worker }}</td>
                            <td>{{ $val->finishgood_per_day }}</td>
                            <td>{{ $val->fuel }}</td>
                            <td>{{ number_format($val->timber,1) }}</td>
                            <td>{{ $val->covering_nylon }}</td>

                            <td>
                                <span class="label label-warning">
                                    <a href="procurement/product/edit/{{$val->id}}"><span class="glyphicon glyphicon-edit">Sửa</span></a>
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