@extends('layout.index')

@section('content')
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>

            <!-- FEEDBACK -->
            <div class="col-md-12">
                <div class="panel panel-primary ">
				  	<div class="panel-heading">DANH BẠ ĐIỆN THOẠI | PHONE BOOK</div>
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

                        <form action="phonebook" method="POST">
		                    <input type="hidden" name="_token" value="{{csrf_token()}}">
		                    
		                    <input  type="text" class="form-control" name="name" placeholder=" Nhập tên người cần kiếm..." style="display: inline;width: 20%">
		
		                    <button type="submit" class="btn btn-default">Tìm kiếm</button>
		                    <hr>
		                </form>

				    	<!-- Thông báo -->
				    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		                    <thead>
		                        <tr align="center">
		                            <th>ID</th>
		                            <th>Tên</th>
		                            <th>SĐT 1</th>
		                            <th>SĐT 2</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	@if(isset($user))
			                        @foreach($user as $us)
			                        <tr class="odd gradeX" align="center">
			                            <td>{{$us->id}}</td>			                            
			                            <td>{{$us->name}}</td>
			                            <td>{{$us->sdt}}</td>
			                            <td>{{$us->sdt2}}</td>			            
			                        </tr>
			                        @endforeach
			                    @endif
		                    </tbody>
		                </table> <!-- End Thông báo -->
		                <div>@if(Session('$user')) {{$user->links()}} @endif </div>
		                <hr>
				    	
				    	
				    	
				  	</div>
				</div>
            </div>
            <!-- End FEEDBACK -->
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>

@endsection

@section('content')
  <script>
	    $( function() {
		    $( "#datepicker" ).datepicker({
		      showButtonPanel: true
		    });
		  } );

  </script>
@endsection