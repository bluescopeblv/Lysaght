@extends('layout.index')

@section('css')
    
@endsection
@section('content')
<div class="container">
<!-- Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white"><a href="dashboard/hr">Danh sách</a></h4>
            </div>
            <div class="card-body">
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
                <form action="dashboard/hr/add" method="post">
                	<input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <h3 class="card-title">Thông tin</h3>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Total Employees (Only Lysaght)</label>
                                    <input type="text" name="total_employees" class="form-control" placeholder="Tổng nhân viên">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Female Employees (Only Lysaght)</label>
                                    <input type="text" name="female_employees" class="form-control form-control-danger" placeholder="Số nhân viên nữ">
                                </div>
                            </div>
                            <!--/span-->
                            
                            
                        </div>
                        <!--/row-->
                        
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Thêm</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Row -->
</div>

@endsection

@section('script')
  <script>
	   
  </script>
@endsection