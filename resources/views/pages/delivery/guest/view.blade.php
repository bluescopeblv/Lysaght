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
                <span><a href="delivery/guest/">Quay lại</a></span>
                 
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
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <h3 class="card-title">Dự án:  <span style="color: blue">{{$thongtinxe->khachhang}}</span> {!! getDeliveryStatus($thongtinxe->status) !!}</h3>
                        <hr>
                        <div class="row">
                        <div class="col-md-6">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Mô tả</th>
                                <th>Thời gian</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>Kế hoạch</td>
                                <td>@if($thongtinxe->thoigiankehoach != NULL)
                                    {{ date('d-m-Y H:i:s',strtotime($thongtinxe->thoigiankehoach))}}
                                @endif</td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>Xe vào</td>
                                <td>@if($thongtinxe->thoigianxevao != NULL)
                                    {{ date('d-m-Y H:i:s',strtotime($thongtinxe->thoigianxevao))}}
                                @endif</td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td>Bắt đầu chất hàng</td>
                                <td>@if($thongtinxe->thoigianbatdauchathang != NULL)
                                    {{ date('d-m-Y H:i:s',strtotime($thongtinxe->thoigianbatdauchathang))}}
                                @endif</td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td>Đã chất hàng xong</td>
                                <td>@if($thongtinxe->thoigianketthucchathang != NULL)
                                    {{ date('d-m-Y H:i:s',strtotime($thongtinxe->thoigianketthucchathang))}}
                                @endif</td>
                              </tr>
                              <tr>
                                <td>5</td>
                                <td>Xe đã ra</td>
                                <td>@if($thongtinxe->thoigianxera != NULL)
                                    {{ date('d-m-Y H:i:s',strtotime($thongtinxe->thoigianxera))}}
                                @endif</td>
                              </tr>
                              
                            </tbody>
                          </table>
                        </div>
                        

                        <div class="col-md-6">
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>                                
                                        <th>CO</th>
                                        <th>Sản phẩm</th>                               
                                        <th>Chi tiết</th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($CO as $key => $val)
                                    <tr>                               
                                        <td>{{$val->CO}}</td>
                                        <td>{{$val->sanpham}}</td>
                                        <td>
                                            {{$val->chitietgiaohang}}
                                        </td>                           
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Khách hàng, dự án</label>
                                    <input type="text" name="khachhang" class="form-control" placeholder="Nhập tên khách hàng, dự án..." value="{{ $thongtinxe->khachhang }}" disabled="">
                                     </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Tên tài xế</label>
                                    <input type="text" name="tentaixe" class="form-control form-control-danger" placeholder="Nhập tên tài xế" value="{{ $thongtinxe->tentaixe }}" disabled="">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Biển số</label>
                                    <input type="text" name="bienso" class="form-control form-control-danger" placeholder="Nhập biển số xe" value="{{ $thongtinxe->bienso }}" disabled="">
                                    </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Nhà xe</label>
                                    <input type="text" name="nhaxe" class="form-control form-control-danger" placeholder="Tên nhà xe" value="{{ $thongtinxe->nhaxe }}" disabled="">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tải trọng xe (Tấn)</label>
                                <input type="text" name="taitrongxe" class="form-control form-control-danger" placeholder="Nhập tải trọng xe" value="{{ $thongtinxe->taitrongxe }}" disabled="">
                            </div>    
                        </div>
                        
                        <!--/span-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Chiều dài xe (Mét)</label>
                                <input type="text" name="chieudaixe" class="form-control form-control-danger" placeholder="Nhập chiều dài xe" value="{{ $thongtinxe->chieudaixe }}" disabled="">
                            </div>
                        </div>
                                         
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời gian xe vào <span><small>(dd-mm-yyyy hh:ii:ss)</small></span></label>
                                    <input type="text" name="thoigianxevao" class="form-control form-control-danger" placeholder="Thời gian xe vào" value="{{ $thongtinxe->thoigianxevao }}" disabled="">
                                </div>    
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời gian xe ra <span><small>(dd-mm-yyyy hh:ii:ss)</small></span></label>
                                    <input type="text" name="thoigianxera" class="form-control form-control-danger" placeholder="Nhập thời gian xe ra" value="{{ $thongtinxe->thoigianxera }}" disabled="" >
                                </div>    
                            </div>
                        </div>

                        <h4 class="card-title">Dành cho Logistic</h4>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Giao hàng bởi</label>
                                    <select class="form-control" name="giaohangboi" disabled="">
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
                                    <select class="form-control" name="loaihang" disabled="">
                                        <option value="DA" 
                                            @if($thongtinxe->giaohangboi == "DA")
                                                selected=""
                                            @endif

                                        >DA</option>
                                        <option value="LE">LE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Time xác nhận xong</label>
                                    <input type="text" name="thoigianlogisticConfirm" class="form-control form-control-danger" placeholder="Thời gian xong" value="{{ $thongtinxe->thoigianlogisticConfirm }}" disabled="">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Time thanh toán </label>
                                    <input type="text" name="thoigianthanhtoan" class="form-control form-control-danger" placeholder="yyyy-mm-dd hh:mm:ss" value="{{ $thongtinxe->thoigianthanhtoan }}" disabled="">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Time kế hoạch xe vào</label>
                                    <input type="datetime" name="thoigiankehoach" class="form-control form-control-danger" placeholder="yyyy-mm-dd hh:mm:ss" value="{{ $thongtinxe->thoigiankehoach }}" disabled="">
                                </div>
                            </div>
                            <!--/span-->


                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Thời gian hoàn thành DN</label>
                                    <input type="text" name="thoigianxongDN" class="form-control form-control-danger" placeholder="Thời gian hoàn thành DN" value="{{ $thongtinxe->thoigianxongDN }}" disabled="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Thời gian hoàn thành phiếu xuất kho</label>
                                    <input type="text" name="thoigianxongPXK" class="form-control form-control-danger" placeholder="Thời gian hoàn thành phi xuất kho" value="{{ $thongtinxe->thoigianxongPXK }}" disabled="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Note</label>
                                    <input type="text" name="notelogistic" class="form-control form-control-danger" placeholder="Ghi chú" value="{{ $thongtinxe->notelogistic }}" disabled="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Số đơn hàng</label>
                                    <input type="text" name="sodonhang" class="form-control form-control-danger" placeholder="Số đơn hàng" value="{{$thongtinxe->sodonhang}}" disabled="">
                                </div>
                            </div>
                                
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">CS</label>
                                    <input type="text" name="tencs" class="form-control form-control-danger" placeholder="Tên CS" value="{{$thongtinxe->tencs}}" disabled="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Chiều dài hàng (m)</label>
                                    <input type="text" name="chieudaihang" class="form-control form-control-danger" placeholder="Chiều dài hàng" value="{{$thongtinxe->chieudaihang}}" disabled="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Khối lượng hàng (tấn)</label>
                                    <input type="text" name="khoiluonghang" class="form-control form-control-danger" placeholder="Khối lượng hàng" value="{{$thongtinxe->khoiluonghang}}" disabled="">
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