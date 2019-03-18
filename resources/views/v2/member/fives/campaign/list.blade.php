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
                <span class="tieude">5S - DANH SÁCH ĐỢT ĐÁNH GIÁ<span style="color: green"></span></span>
                <!-- <span style="float:right; display: block">
                <a href="fives/evaluate/fs-group/add">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Thêm mới </button></a></span> -->
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
                <table class="table table-striped table-bordered table-hover" id="myTable">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Đợt đánh giá</th>
                            <th>Note</th>
                            <th>Đã đánh giá</th>
                            <th>Xem theo Big group</th>
                            <th>Action</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($campaign as $key => $val)
                        <tr class="odd gradeX" align="center">
                            <td>{{$val->id}}</td>

                            <td>{{$val->name}}</td>
                            <td>{{$val->note}}</td>

                            <td><a href="fives/evaluate/main/{{$val->id}}">{{get5Sdanhgia($val->id)}}</a></td>

                            <td class="center"><i class="fa fa-eye fa-fw"></i> <a href="fives/evaluate/result/{{$val->id}}">Xem</a></td>

                            <td class="center"><i class="fa  fa-check-square-o fa-fw"></i> <a href="fives/evaluate/main/add/{{$val->id}}">Chấm điểm >></a></td>

                            <td class="center"><i class="fa fa-trash fa-fw"></i> <a href="fives/evaluate/campaign/delete/{{$val->id}}">Xóa</a></td>
                                                                                   
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="fives/evaluate/campaign/edit/{{$val->id}}">Sửa</a></td>
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