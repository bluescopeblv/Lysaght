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
                <span class="tieude">LOGISTIC - EXPORT</span>
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
                    <form action="delivery2/report/export" method="POST">
                        <label>Chọn ngày</label>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        
                        <input  type="date" id="myDate" class="form-control" name="DateFind" value="{{ date('Y-m-d',strtotime( $today )) }}" style="display: inline;width: 20%">
                        <label>đến ngày</label>
                        <input  type="date" class="form-control" name="DateFind2" value="{{ date('Y-m-d',strtotime( $today )) }}" style="display: inline;width: 20%">
                        <hr>
                        <button type="submit" class="btn btn-default">Tải xuống</button>
                        <!-- @if(isset($ngay))
                        <h4>Ngày <span style="color: blue">{{date('d-m-Y',strtotime($ngay))}}</span> đến <span style="color: blue">{{date('d-m-Y',strtotime($ngay2))}}</span> </h4>
                        @endif -->

                    </form>
                

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