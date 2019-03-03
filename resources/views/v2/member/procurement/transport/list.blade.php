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
                <span class="tieude">PROCUREMENT - TRANSPORT</span>
                <span style="float:right; display: block">
                <a href="procurement/transport/add">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Thêm địa điểm mới </button></a></span>
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
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}           
                    </div>
                @endif
                <table id="myTable" class="table table-bordered table-striped color-bordered-table info-bordered-table hover-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Địa điểm</th>
                            <th>Khoảng cách</th>
                            <th>Giá vận chuyển máy VND</th>
                            
                            <th>Giá vận chuyển coil VND</th>
                            <th>Giá vận chuyển Accesory VND</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($transports as $key=>$val)
                        <tr>
                            <td>{{ $val->id }}</td>
                            <td>{{ $val->location }}</td>
                            <td>{{ $val->distance }}</td>
                            <td>{{ number_format($val->machinery_movement) }}</td>
                            <td>{{ number_format($val->coil_movement) }}</td>
                            <td>{{ number_format($val->accessories_movement) }}</td>
                            
                            <td>
                                <span class="label label-warning" style="padding-left: 5px; padding-right: 5px">
                                    <a href="procurement/transport/edit/{{$val->id}}"><span class="glyphicon glyphicon-edit">Sửa</span></a>
                                </span> 
                                <span class="label label-warning" style="padding-left: 5px; padding-right: 5px">
                                    <a href="procurement/transport/delete/{{$val->id}}"><span class="glyphicon glyphicon-remove">Xóa</span></a>
                                </span> 
                                
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
    //$('#myTable').DataTable();
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
             
            "displayLength": 15,
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
             
        });
         
    });
});



</script>
 


@endsection