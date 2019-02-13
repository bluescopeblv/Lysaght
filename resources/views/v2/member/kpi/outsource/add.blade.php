@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
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
                <span class="tieude">LOGISTIC - THÊM KẾ HOẠCH</span>
                <span style="float:right; display: block">
                <a href="delivery2/logistic">
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
                <form action="delivery/logistic/add" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <div class="panel-group">
                        <div class="panel panel-info">
                            <div class="panel-heading">KẾ HOẠCH | Thêm mới</div>
                            <div class="panel-body">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Khách hàng, dự án</label>
                                        <input type="text" name="khachhang" class="form-control" placeholder="Nhập tên khách hàng, dự án...">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Tên tài xế</label>
                                        <input type="text" name="tentaixe" class="form-control form-control-danger" placeholder="Nhập tên tài xế" value="">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Biển số</label>
                                        <input type="text" name="bienso" class="form-control form-control-danger" placeholder="Nhập biển số xe" value="">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Nhà xe</label>
                                        <input type="text" name="nhaxe" class="form-control form-control-danger" placeholder="Tên nhà xe" value="">
                                    </div>
                                </div>
                                <!--/row-->
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tải trọng xe (Tấn)</label>
                                        <input type="text" name="taitrongxe" class="form-control form-control-danger" placeholder="Nhập tải trọng xe">
                                    </div>    
                                </div>
                                
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Chiều dài xe (Mét)</label>
                                        <input type="text" name="chieudaixe" class="form-control form-control-danger" placeholder="Nhập chiều dài xe">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">CHI TIẾT</div>
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Giao hàng bởi</label>
                                        <select class="form-control" name="giaohangboi">
                                            <option value="BLV">BLV</option>
                                            <option value="EXW">EXW</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Loại hàng</label>
                                        <select class="form-control" name="loaihang">
                                            <option value="DA">DA</option>
                                            <option value="LE">LE</option>
                                        </select>
                                    </div>
                                </div>                            
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Time kế hoạch xe vào</label>
                                        <input type="datetime" name="thoigiankehoach" class="form-control form-control-danger" placeholder="yyyy-mm-dd hh:mm:ss" value="{{date('Y-m-d H:i:s')}}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Time kế hoạch xe ra</label>
                                        <input type="text" name="thoigiankehoachxera" class="form-control form-control-danger" placeholder="yyyy-mm-dd hh:mm:ss" value="{{date('Y-m-d H:i:s')}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Mã dự án</label>
                                        <input type="text" name="maduan" class="form-control form-control-danger" placeholder="Mã dự án">
                                    </div>
                                </div>
                                <!--/span-->
                                                               
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Note</label>
                                        <input type="text" name="notelogistic" class="form-control form-control-danger" placeholder="Ghi chú">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Số đơn hàng</label>
                                        <input type="text" name="sodonhang" class="form-control form-control-danger" placeholder="Số đơn hàng" value="">
                                    </div>
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="form-group has-danger">
                                        <label class="control-label">CS</label>
                                        <input type="text" name="tencs" class="form-control form-control-danger" placeholder="Tên CS" value="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Chiều dài hàng (m)</label>
                                        <input type="text" name="chieudaihang" class="form-control form-control-danger" placeholder="Chiều dài hàng" value="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Khối lượng hàng (tấn)</label>
                                        <input type="text" name="khoiluonghang" class="form-control form-control-danger" placeholder="Khối lượng hàng">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Picking list đính kèm</label>
                                        <input type="file" name="file_pickinglist">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                      </div>

                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Thêm</button>
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