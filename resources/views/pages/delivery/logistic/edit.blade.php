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
                <span><a href="delivery/logistic/">Quay lại</a></span>
                <span class="label label-warning" style="float: right;">
                    <a href="delivery/logistic/reset/{{$thongtinxe->id}}"><span class="glyphicon glyphicon-edit">Reject</span></a>
                </span>
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
                <form action="delivery/logistic/edit/{{$thongtinxe->id}}" method="post" enctype="multipart/form-data">
                	<input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <h3 class="card-title">Chỉnh sửa dự án:  <span style="color: blue">{{$thongtinxe->khachhang}}</span></h3>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Khách hàng, dự án</label>
                                    <input type="text" name="khachhang" class="form-control" placeholder="Nhập tên khách hàng, dự án..." value="{{ $thongtinxe->khachhang }}">
                                     </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Tên tài xế</label>
                                    <input type="text" name="tentaixe" class="form-control form-control-danger" placeholder="Nhập tên tài xế" value="{{ $thongtinxe->tentaixe }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Biển số</label>
                                    <input type="text" name="bienso" class="form-control form-control-danger" placeholder="Nhập biển số xe" value="{{ $thongtinxe->bienso }}">
                                    </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Nhà xe</label>
                                    <input type="text" name="nhaxe" class="form-control form-control-danger" placeholder="Tên nhà xe" value="{{ $thongtinxe->nhaxe }}">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tải trọng xe (Tấn)</label>
                            	<input type="text" name="taitrongxe" class="form-control form-control-danger" placeholder="Nhập tải trọng xe" value="{{ $thongtinxe->taitrongxe }}">
                            </div>    
                        </div>
                        
                        <!--/span-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Chiều dài xe (Mét)</label>
                                <input type="text" name="chieudaixe" class="form-control form-control-danger" placeholder="Nhập chiều dài xe" value="{{ $thongtinxe->chieudaixe }}">
                            </div>
                        </div>
                                         
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời gian xe vào <span><small>(dd-mm-yyyy hh:ii:ss)</small></span></label>
                                	<input type="text" name="thoigianxevao" class="form-control form-control-danger" placeholder="Thời gian xe vào" value="{{ $thongtinxe->thoigianxevao }}">
                                </div>    
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời gian xe ra <span><small>(dd-mm-yyyy hh:ii:ss)</small></span></label>
                                	<input type="text" name="thoigianxera" class="form-control form-control-danger" placeholder="Nhập thời gian xe ra" value="{{ $thongtinxe->thoigianxera }}">
                                </div>    
                            </div>
                        </div>

                        <h4 class="card-title">Dành cho Bộ phận giao hàng</h4>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Sản phẩm</label>
                                    <input type="text" name="sanpham" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ $thongtinxe->sanpham }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Hàng dài nhất (m)</label>
                                    <input type="text" name="chieudai" class="form-control form-control-danger" placeholder="Chiều dài" value="{{ $thongtinxe->chieudai }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Khối lượng (Tấn)</label>
                                    <input type="text" name="khoiluong" class="form-control form-control-danger" placeholder="Khối lượng" value="{{ $thongtinxe->khoiluong }}">
                                    </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Số kiện</label>
                                    <input type="text" name="sokien" class="form-control form-control-danger" placeholder="Số kiện hàng đã chất" value="{{ $thongtinxe->sokien }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Số dây ràng</label>
                                    <input type="text" name="sodayrang" class="form-control form-control-danger" placeholder="Số dây ràng" value="{{ $thongtinxe->sodayrang }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Ghi chú</label>
                                    <input type="text" name="noteproduction" class="form-control form-control-danger" placeholder="Ghi chú" value="{{ $thongtinxe->noteproduction }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Thời gian huấn luyện xong tài xế</label>
                                    <input type="text" name="thoigianhuanluyen" class="form-control form-control-danger" placeholder="Thời gian huấn luyện xong tài xế" value="{{ $thongtinxe->thoigianhuanluyen }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Thời gian bắt đầu chất hàng</label>
                                    <input type="text" name="thoigianbatdauchathang" class="form-control form-control-danger" placeholder="Thời gian bắt đầu chất hàng" value="{{ $thongtinxe->thoigianbatdauchathang }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Thời gian kết thúc chất hàng</label>
                                    <input type="text" name="thoigianketthucchathang" class="form-control form-control-danger" placeholder="Thời gian kết thúc chất hàng" value="{{ $thongtinxe->thoigianketthucchathang }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Thời gian bàn giao DN/DO</label>
                                    <input type="text" name="thoigianbagiaoDN" class="form-control form-control-danger" placeholder="Thời gian bàn giao DN/DO" value="{{ $thongtinxe->thoigianbagiaoDN }}">
                                </div>
                            </div>
                            
                        </div>

                        <h4 class="card-title">Dành cho Logistic</h4>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Giao hàng bởi</label>
                                    <select class="form-control" name="giaohangboi" >
                                        <option value="BLV" 
                                        @if($thongtinxe->giaohangboi == "BLV")
                                            selected=""
                                        @endif>BLV</option>
                                        <option value="EXW" @if($thongtinxe->giaohangboi == "EXW")
                                            selected=""
                                        @endif>EXW</option>
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Loại hàng</label>
                                    <select class="form-control" name="loaihang">
                                        <option value="DA"
                                        @if($thongtinxe->loaihang == "DA")
                                            selected=""
                                        @endif
                                        >DA</option>
                                        <option value="LE" @if($thongtinxe->loaihang == "LE")
                                            selected=""
                                        @endif >LE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Time xác nhận xong</label>
                                    <input type="text" name="thoigianlogisticConfirm" class="form-control form-control-danger" placeholder="Thời gian xong" value="{{ $thongtinxe->thoigianlogisticConfirm }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Time thanh toán </label>
                                    <input type="text" name="thoigianthanhtoan" class="form-control form-control-danger" placeholder="yyyy-mm-dd hh:mm:ss" value="{{ $thongtinxe->thoigianthanhtoan }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Time kế hoạch xe vào</label>
                                    <input type="datetime" name="thoigiankehoach" class="form-control form-control-danger" placeholder="yyyy-mm-dd hh:mm:ss" value="{{ $thongtinxe->thoigiankehoach }}">
                                </div>
                            </div>
                            <!--/span-->


                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Thời gian hoàn thành DN</label>
                                    <input type="text" name="thoigianxongDN" class="form-control form-control-danger" placeholder="Thời gian hoàn thành DN" value="{{ $thongtinxe->thoigianxongDN }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Thời gian hoàn thành phiếu xuất kho</label>
                                    <input type="text" name="thoigianxongPXK" class="form-control form-control-danger" placeholder="Thời gian hoàn thành phi xuất kho" value="{{ $thongtinxe->thoigianxongPXK }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Note</label>
                                    <input type="text" name="notelogistic" class="form-control form-control-danger" placeholder="Ghi chú" value="{{ $thongtinxe->notelogistic }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Số đơn hàng</label>
                                    <input type="text" name="sodonhang" class="form-control form-control-danger" placeholder="Số đơn hàng" value="{{$thongtinxe->sodonhang}}">
                                </div>
                            </div>
                                
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">CS</label>
                                    <input type="text" name="tencs" class="form-control form-control-danger" placeholder="Tên CS" value="{{$thongtinxe->tencs}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Chiều dài hàng (m)</label>
                                    <input type="text" name="chieudaihang" class="form-control form-control-danger" placeholder="Chiều dài hàng" value="{{$thongtinxe->chieudaihang}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Khối lượng hàng (tấn)</label>
                                    <input type="text" name="khoiluonghang" class="form-control form-control-danger" placeholder="Khối lượng hàng" value="{{$thongtinxe->khoiluonghang}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select class="form-control" name="status">
                                        @foreach($all_status as $key => $val)
                                        <option value="{{ $val->status}}"
                                        @if($val->status == $thongtinxe->status)
                                            selected=""
                                        @endif
                                        >{{ $val->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Display</label>
                                    <select class="form-control" name="public_display" style="color: 
                                        @if($thongtinxe->public_display == 0)
                                            red
                                        @else 
                                            green

                                        @endif">
                                        <option value="1" 
                                        @if($thongtinxe->public_display == 1)
                                            selected=""
                                        @endif
                                        >Hiển thị</option>
                                        
                                        <option value="0"
                                        @if($thongtinxe->public_display == 0)
                                            selected=""
                                        @endif
                                        >Không Hiển thị</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Picking list đính kèm(PDF, Excel): 
                                        @if($thongtinxe->file_pickinglist)
                                            <a href="upload/delivery/pickinglist/{{$thongtinxe->file_pickinglist}}">Đã có file pickinglist: {{substr($thongtinxe->file_pickinglist,0,strlen($thongtinxe->file_pickinglist)-19).substr($thongtinxe->file_pickinglist,strlen($thongtinxe->file_pickinglist)-4,4)}}</a>
                                        @else
                                            
                                        @endif
                                        <!-- //strlen($chiphi->tenchungtu) - 12 -->
                                    </label>
                                    <input type="file" name="file_pickinglist">
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Sửa</button>
                        
                    </div>
                </form>

                <hr>
                <div class="row">
                    <!-- column -->
                    @foreach($pictures as $picture)
                    <div class="col-lg-3 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <img class="card-img-top img-responsive" src="upload/delivery/done/{{$picture->link_hinh}}" alt="Card image cap">
                            <div class="btn btn-info"> {{ $thongtinxe->khachhang }} </div>
                        </div>                    
                    </div>
                    @endforeach
                </div>
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