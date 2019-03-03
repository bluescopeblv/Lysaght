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
                <span class="tieude">PROCUREMENT - ADD</span>
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
                <form action="procurement/transport/add" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <div class="panel-group">
                        <div class="panel panel-info">
                            <div class="panel-heading">KẾ HOẠCH | Thêm mới</div>
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Địa điểm/Tỉnh</label>
                                        <input type="text" name="location" class="form-control" placeholder="Nhập tên địa điểm, tình thành...">
                                    </div>
                                </div>
                                <!--/span-->
                                

                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Khoảng cách</label>
                                        <input type="text" name="distance" class="form-control form-control-danger" placeholder="Khoảng cách" value="">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Giá vận chuyển máy (VND)</label>
                                        <input type="text" name="machinery_movement" class="form-control form-control-danger" placeholder="Giá vận chuyển máy" value="">
                                    </div>
                                </div>
                                <!--/row-->
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Giá vận chuyển coil (VND)</label>
                                        <input type="text" name="coil_movement" class="form-control form-control-danger" placeholder="Giá vận chuyển coil">
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Giá vận chuyển Accessories (VND)</label>
                                        <input type="text" name="accessories_movement" class="form-control form-control-danger" placeholder="Giá vận chuyển Accessories">
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
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Import thông tin CO</div>

            <div class="panel-body"> 

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">Tải file mẫu: 
                        <a href="{{ route('export.Trans',['type'=>'xls']) }}">Exel xls</a> |
                        <a href="{{ route('export.Trans',['type'=>'xlsx']) }}">Excel xlsx</a> |
                        <a href="{{ route('export.Trans',['type'=>'csv']) }}">CSV</a>
                    </div>
                </div>     
                <hr>
                {!! Form::open(array('route' => array('import.Trans'),'method'=>'POST','files'=>'true')) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('sample_file','Chọn file cần import:',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">

                            {!! Form::file('sample_file', array('class' => 'form-control')) !!}
                            {!! $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    {!! Form::submit('Tải lên',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
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