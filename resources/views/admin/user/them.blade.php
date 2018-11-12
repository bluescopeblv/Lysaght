@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
	<div id="page-wrapper">
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-lg-12">
	                <h1 class="page-header">User
	                    <small>Thêm</small>
	                </h1>
	            </div>
	            <!-- /.col-lg-12 -->
	            <div class="col-lg-7" style="padding-bottom:120px">

	            	@if(count($errors)>0)
	            		<div class="alert alert-danger">
	            			@foreach($errors->all() as $err)
	            				{{$err}}<br>
	            			@endforeach
	            		</div>
	            	@endif

	            	@if(session('notification'))
	            		<div class="alert alert-success">
							{{session('notification')}}	            			
	            		</div>
	            	@endif

	                <form action="admin/user/them" method="POST">
	                    <input type="hidden" name="_token" value="{{csrf_token()}}">
	                    <div class="form-group">
	                        <label>Họ và tên</label>
	                        <input class="form-control" name="name" placeholder="Nhập họ tên người dùng" />
	                    </div>
	                    <div class="form-group">
	                        <label>Email</label>
	                        <input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ Email" />
	                    </div>
	                    <div class="form-group">
	                        <label>Workcenter</label>
	                        <select class="form-control" name="workcenter">
		                            <option value="Purlin400">Purlin 400</option>
	                        </select>
	                    </div>
	                    <div class="form-group">
	                    	
	                        <label>Mật khẩu</label>
	                        <input type="password" class="form-control password" name="password" placeholder="Nhập mật khẩu"  />
	                    </div>
	                    <div class="form-group">
	                        <label>Nhập lại mật khẩu</label>
	                        <input type="password" class="form-control password" name="passwordAgain" placeholder="Nhập lại mật khẩu" />
	                    </div>
	                    
	                    <div class="form-group">
	                        <label>Quyền người dùng</label>
	                        <label class="radio-inline">
	                            <input name="quyen" value="0" checked="" type="radio">Không có quyền
	                        </label>
	                        <label class="radio-inline">
	                            <input name="quyen" value="1" checked="" type="radio">Thường
	                        </label>
	                        <label class="radio-inline">
	                            <input name="quyen" value="2" type="radio">Bảo trì
	                        </label>
	                        <label class="radio-inline">
	                            <input name="quyen" value="3" type="radio">Admin
	                        </label>
	                        
	                    </div>
	                    <button type="submit" class="btn btn-default">Thêm</button>
	                    <button type="reset" class="btn btn-default">Làm mới</button>
	                </form>
	            </div>
	        </div>
	        <!-- /.row -->
	    </div>
	    <!-- /.container-fluid -->
	</div>
<!-- /#page-wrapper -->

@endsection

