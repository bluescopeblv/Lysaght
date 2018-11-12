@extends('layout.index')

@section('content')
    <div class="container">
    	<div class="panel panel-primary">
     		<div class="panel-heading">5S - XUẤT FILE EXCEL</div>
    		<div class="panel-body"> 
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<a href="{{ route('export.5s.list',['type'=>'xls']) }}">Download Excel xls</a> |
						<a href="{{ route('export.5s.list',['type'=>'xlsx']) }}">Download Excel xlsx</a> |
						<a href="{{ route('export.5s.list',['type'=>'csv']) }}">Download CSV</a>
					</div>
				</div>     

		    </div>
		</div>
    	
    </div>

@endsection

@section('script')
	<script>
	  	$(document).ready(function() {
	        $('#dataTables-example').DataTable({
	            responsive: true
	        });
	    });
	</script>
@endsection