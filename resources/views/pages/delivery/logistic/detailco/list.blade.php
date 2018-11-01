@extends('layout.index')

@section('content')
<div class="container">
	<div class="row page-titles">
        <div class="col-md-2 align-self-center">
            <h4 class="text-themecolor">LOGISTIC</h4>
        </div>
        <div class="col-md-10 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    Dự án: <span style="color: blue">{{ $thongtinxe->khachhang }}</span> |
                    Nhà xe:<span style="color: blue">{{ $thongtinxe->nhaxe }}</span> | 
                    Giao hàng bởi: <span style="color: blue"> {{ $thongtinxe->giaohangboi }}</span> |
                    <a href="delivery/logistic">Quay lại</a>  

                
                <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i><a href="delivery/logistic/detailco/{{$thongtinxe->id}}/add"> Thêm mới</a> </button>

                </ol>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thông tin CO</h4>
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}           
                </div>
            @endif
            <div class="table-responsive m-t-40">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CO</th>
                            <th>Chi tiết</th>
                            
                            <th>Status</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($CO as $key => $val)
                        <tr>
                            <td>{{$val->id}}</td>
                            <td>{{$val->CO}}</td>
                            <td>{{$val->chitietgiaohang}}</td>
                            <td>
                               {!! getDeliveryStatus($thongtinxe->status)  !!}
                            </td>
                            
                            <td>
                                <span class="label label-warning">
                                    <a href="delivery/logistic/detailco/{{$thongtinxe->id}}/edit/{{$val->id}}"><span class="glyphicon glyphicon-edit">Sửa</span></a>
                                </span><span>  </span>
                                <span class="label label-danger">
                                    <a href="delivery/logistic/detailco/{{$thongtinxe->id}}/delete/{{$val->id}}"><span class="glyphicon glyphicon-remove-sign">Xóa</span></a>
                                </span>
                                
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <div class="panel panel-primary">
        <div class="panel-heading">Import thông tin CO</div>

        <div class="panel-body"> 

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">Tải file mẫu: 
                    <a href="{{ route('export.CO',['type'=>'xls']) }}">Exel xls</a> |
                    <a href="{{ route('export.CO',['type'=>'xlsx']) }}">Excel xlsx</a> |
                    <a href="{{ route('export.CO',['type'=>'csv']) }}">CSV</a>
                </div>
            </div>     
            <hr>
            {!! Form::open(array('route' => array('import.CO',$thongtinxe->id),'method'=>'POST','files'=>'true')) !!}
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
@endsection

@section('script')
<script>
  	$(document).ready(function() {
	    $('#myTable').DataTable();
	    $(document).ready(function() {
	        var table = $('#example').DataTable({
	            "columnDefs": [{
	                "visible": false,
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