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
                <h4 class="m-b-0 text-white"><a href="delivery/baove/">Danh sách xe</a></h4>
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
                <form action="delivery/baove/add" method="post">
                	<input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <h3 class="card-title">Thông tin</h3>
                        <hr>
                        <div class="row p-t-20">
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
                                    <input type="text" name="tentaixe" class="form-control form-control-danger" placeholder="Nhập tên tài xế">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Biển số</label>
                                    <input type="text" name="bienso" class="form-control form-control-danger" placeholder="Nhập biển số xe">
                                    </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Nhà xe</label>
                                    <input type="text" name="nhaxe" class="form-control form-control-danger" placeholder="Tên nhà xe">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
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
                                                 
                        
                        <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <label class="control-label">Thời gian xe vào <span><small>(Ngày-Tháng-Năm Giờ:Phút:Giây)</small></span></label>
                                	<input type="text" name="thoigianxevao" class="form-control form-control-danger" placeholder="Mặc định" value="{{date('d-m-Y H:i:s')}}" disabled="">
                                </div>    
                            </div>
                        </div> -->
                        
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Thêm</button>
                        <button type="button" class="btn btn-inverse">Cancel</button>
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