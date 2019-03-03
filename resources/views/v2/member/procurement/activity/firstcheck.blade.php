@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
.white-box{
    font-family: "Arial";
    color: blue;
}

.tieude{
    font-family: "Arial";
    color: blue;
    font-size: 20px;
    font-style: bold;
}
.white-box{
    color: black;
}
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-body">
                <span class="tieude">ROS - PRICE CHECK</span>
                
                
            </div>
        </div>
    </div>
</div>

<!-- /row -->
<div class="row">
    
    <div class="col-sm-12">
        @if(Auth::check())
        <div class="white-box">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
            @endif

            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}           
                </div>
            @endif
            <form action="procurement/activity/firstcheck" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-body">
                    <div class="panel-group">
                    <div class="panel panel-info">
                        <div class="panel-heading" style="color: white;background-color: blue;font-size: 18px;font-family: "arial">Giới hạn tải trọng của cầu đường...</div>
                        <div class="panel-body">
                            
                            <div class="col-md-12" style="text-align: center;">
                                <select class="form-control" name="firstcheck">
                                    <option value="0"> > 42 Tấn (Lớn hơn 42 Tấn) </option>
                                    <option value="1"> < 42 Tấn (Nhỏ hơn 42 Tấn) </option>
                                </select>
                                <br>
                                <button  type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Check</button>
                            </div>
                        </div>
                    </div>
                    </div>

                </div>
            </form>
        </div>
        @else
            <div class="white-box">
            Please login at <a href="/L3/public/dangnhap">here</a>
        </div>
        @endif
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