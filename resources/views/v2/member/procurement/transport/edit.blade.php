@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
.white-box{
    font-family: "Arial";
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
                <span class="tieude">PROCUREMENT - EDIT <span style="color: green">{{ $transport->location }}</span></span>
                <span style="float:right; display: block">
                <a href="procurement/transport">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Quay về danh sách </button></a></span>
            </div>
        </div>
    </div>
</div>

<!-- /row -->
<div class="row">
    <div class="col-sm-12">
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
                <form action="procurement/transport/edit/{{ $transport->id }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <div class="panel-group">
                        <div class="panel panel-info">
                            <div class="panel-heading">KẾ HOẠCH | Thêm mới</div>
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Địa điểm/Tỉnh</label>
                                        <input type="text" name="location" class="form-control" placeholder="Nhập tên địa điểm, tình thành..." value="{{$transport->location }}">
                                    </div>
                                </div>
                                <!--/span-->
                                

                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Khoảng cách</label>
                                        <input type="text" name="distance" class="form-control form-control-danger" placeholder="Khoảng cách" value="{{$transport->distance }}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Giá vận chuyển máy (VND)</label>
                                        <input type="text" name="machinery_movement" class="form-control form-control-danger" placeholder="Giá vận chuyển máy" value="{{$transport->machinery_movement }}">
                                    </div>
                                </div>
                                <!--/row-->
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Giá vận chuyển coil (VND)</label>
                                        <input type="text" name="coil_movement" class="form-control form-control-danger" placeholder="Giá vận chuyển coil" value="{{$transport->coil_movement }}">
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Giá vận chuyển Accessories (VND)</label>
                                        <input type="text" name="accessories_movement" class="form-control form-control-danger" placeholder="Giá vận chuyển Accessories" value="{{$transport->accessories_movement }}">
                                    </div>    
                                </div>
                                
                            </div>
                        </div>
                        
                        
                        </div>

                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Sửa</button>
                    </div>
                </form>
                
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