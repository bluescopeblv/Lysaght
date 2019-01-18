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
                <h4 class="m-b-0 text-white"><a href="delivery/logistic/">Danh sách xe</a></h4>
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
                <form action="delivery/logistic/add" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <div class="panel-group">
                        <div class="panel panel-default">
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
                        <div class="panel panel-default">
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
</div>
<!-- Row -->
</div>

@endsection

@section('script')
<script>

</script>
@endsection