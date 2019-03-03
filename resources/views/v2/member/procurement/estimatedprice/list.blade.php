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
                <span class="tieude">PROCUREMENT - ESTMATED PRICE</span>
                <span style="float:right; display: block">
                <a href="procurement/estimatedprice/add">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Thêm giá mới </button></a></span>
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
                            <!-- 1 -->
                            <th>#</th>
                            <th>CRANE 45MT FACTORY</th>
                            <th>CRANE 45MT SITE</th>
                            <th>CRANE 8 MT</th>
                            <th>CRANE_LIFTJACK</th>
                            <!-- 2 -->
                            <th>MACHINES INSURANCE</th>
                            <th>GENSET HIRING</th>
                            <th>FUEL FOR GENSET</th>
                            <th>DAU NOI DIEN CONG TRUONG</th>
                            <th>DIEN CONG TRUONG</th>
                            <!-- 3 -->
                            <th>LABOUR COST</th>
                            <th>HEALTH CHECK</th>
                            <th>SAFETY TRAINING CERTIFICATE</th>
                            <th>INSURANCE</th>
                            <th>TECHNICIAN</th>
                            <!-- 4 -->
                            <th>TIMBER PACKAGING ( M3)</th>
                            <th>SAFETY TOOLS, PACKAGING ACC. RUG FOR COVERING</th>
                            <th>COVERING NYLON</th>
                            <th>SECURITIES </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($estiprices as $key=>$val)
                        <tr>
                            <!-- 1 -->
                            <td>{{ $val->id }}</td>
                            <td>{{ number_format( $val->crane_45_factory ) }}</td>
                            <td>{{ number_format( $val->crane_45_site ) }}</td>
                            <td>{{ number_format( $val->crane_8_site ) }}</td>
                            <td>{{ number_format( $val->crane_liftjack ) }}</td>
                            <!-- 2 -->
                            <td>{{ number_format( $val->machines_insurance ) }}</td>
                            <td>{{ number_format( $val->genset_hiring ) }}</td>
                            <td>{{ number_format( $val->fuel_genset ) }}</td>
                            <td>{{ number_format( $val->daunoidien ) }}</td>
                            <td>{{ number_format( $val->electric_site ) }}</td>
                            <!-- 3 -->
                            <td>{{ number_format( $val->labour_cost ) }}</td>
                            <td>{{ number_format( $val->health_check ) }}</td>
                            <td>{{ number_format( $val->safety_certificate ) }}</td>
                            <td>{{ number_format( $val->insurance ) }}</td>
                            <td>{{ number_format( $val->technician ) }}</td>
                            <!-- 4 -->
                            <td>{{ number_format( $val->timber ) }}</td>
                            <td>{{ number_format( $val->safety_tool ) }}</td>
                            <td>{{ number_format( $val->covering_nylon ) }}</td>
                            <td>{{ number_format( $val->security ) }}</td>
                            <td>
                                <span class="label label-warning">
                                    <a href="procurement/estimatedprice/edit/{{$val->id}}"><span class="glyphicon glyphicon-edit">Sửa</span></a>
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