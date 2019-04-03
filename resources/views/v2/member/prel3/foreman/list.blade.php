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
                <span class="tieude">KẾ HOẠCH - FOREMAN</span>
                <span style="float:right; display: block">
                <a href="delivery2/logistic/add">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Tạo kế hoạch mới </button></a></span>
            </div>
        </div>
    </div>
</div>

<!-- /row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">KẾ HOẠCH SẢN XUẤT | <a href="thongke">>> Thống kê</a></div>
            @if(Auth::user())
                @if(Auth::user()->quyen_preL3 >= 1)
                    <div class="panel-body">
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

                        <form action="kehoach/foreman" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <input  type="date" id="myDate" class="form-control" name="DateFind" value="{{ date('Y-m-d') }}" style="display: inline;width: 20%">
                            <input  type="date" class="form-control" name="DateFind2" value="{{ date('Y-m-d') }}" style="display: inline;width: 20%">
                            
                            @if(Auth::user())

                            @if(Auth::user()->quyen_preL3 >= 1)
                            <select class="form-control" name="workcenter" style="display: inline;width: 20%" >
                                <option style="font-size: 16px; color:blue" value="">--Chọn workcenter--</option>
                                @foreach($workcenter as $wc)
                                    <option style="font-size: 16px; color:blue" value="{{$wc->name}}">{{ $wc->name }}</option>
                                @endforeach
                                <option style="font-size: 16px; color:blue" value="all">All</option>
                            </select>
                          
                            @endif

                            @endif

                            <!-- <input  type="text" id="workcenter" class="form-control" name="workcenter" value="Purlin400" style="display: inline;width: 20%" placeholder="Nhập workcenter"> -->
        
                            <button type="submit" class="btn btn-default">Xem kế hoạch </button>
                            <hr>
                        </form>

                        @if(isset($ngayTimKiem))
                            <h4>Ngày <span style="color: blue">{{date('d-m-Y',strtotime($ngayTimKiem))}}</span> đến <span style="color: blue">{{date('d-m-Y',strtotime($ngay2))}}</span> Bạn đang ở workcenter <span style="color: blue">{{$wc1}}</span> </h4>
                        @endif
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    
                            <thead>
                                <tr align="center">
                                    <th>Workcenter</th>
                                    <th>Ngày SX</th>
                                    <th>TT</th>
                                    <th>Dự án</th>
                                    <th>CO</th>
                                    <th>Type</th>
                                    <th>LItem</th>
                                    <th>Deli Date</th>
                                    
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($kehoach))
                                    @foreach($kehoach as $kh)
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$kh->WorkCenter}}</td>
                                        <td>{{date('d-M-Y', strtotime($kh->DateSX_KH_DMY))}}</td>
                                        <td>{{$kh->ThuTuCO}}</td>
                                        <td>{{$kh->DuAn}}</td>
                                        <td>{{$kh->CO}}</td>
                                        <td>{{$kh->Type}}</td>
                                        <td>{{$kh->Litem}}</td>
                                        <td>{{$kh->NgayGH}}</td>
                                        
                                        <td class="center"><i class="glyphicon glyphicon-th-list"></i> <a href="chitiet/{{$kh->CO}}/{{$kh->Litem}}/{{$kh->WorkCenter}}/{{date('Ymd', strtotime($kh->DateSX_KH_DMY))}}/{{$kh->ThuTuCO}}"> Chi tiết...</a></td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        
                    </div>
                @else
                    <h3 style="color: green;text-align: center;" > Bạn không có quyền truy cập vào module này. Để được cấp quyền vui lòng liên hệ foreman hoặc Phúc</h3>
                @endif
            @else
                <h3 style="color: green;text-align: center;" > Bạn vui lòng đăng nhập để xem nội dung.</h3>
            @endif
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