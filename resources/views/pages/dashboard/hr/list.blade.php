@extends('layout.index')

@section('content')
<div class="container">
	<div class="row page-titles">
        <div class="col-md-2 align-self-center">
            <h4 class="text-themecolor">HR</h4>
        </div>
        <div class="col-md-10 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Data</li>
                
                <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i><a href="dashboard/hr/add"> Thêm mới</a> </button>

                </ol>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}           
                </div>
            @endif
            <div class="table-responsive m-t-40">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Total employee</th>
                            <th>Updated at</th>

                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($hr as $key => $val)
                        <tr>
                            <td>{{ $val->id }}</td>
                            <td>{{ $val->total_employees -   $val->female_employees }}</td>
                            <td>{{ $val->female_employees }}</td>
                            <td>{{ $val->total_employees }}</td>
                            <td>{{ date('d-M-Y',strtotime($val->updated_at)) }}</td>
                            <td>
                                @if($key == 0)
                                    <span class="label label-success">Display</span>
                                @endif
                            </td>
                           
                            <td>
                                @if( date('d-M-Y',strtotime($val->updated_at)) == date('d-M-Y'))
                            	<span class="label label-info">
                            		<a href="dashboard/hr/edit/{{$val->id}}"><span class="glyphicon glyphicon-edit">Edit</span></a>
                            	</span>
                                <span style="margin-left: 5px">  </span>
                                <span class="label label-warning">
                                    <a href="dashboard/hr/delete/{{$val->id}}"><span class="glyphicon glyphicon-edit">Delete</span></a>
                                </span>
                            	@endif
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