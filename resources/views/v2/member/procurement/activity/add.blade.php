@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="v2/member/css/form-icheck.css" rel="stylesheet">
<link href="v2/member/js/icheck/skins/all.css" rel="stylesheet">
<style type="text/css">
.white-box{
    font-family: "Arial";
    color: blue;
}

.tieude{
    font-family: "Arial";
    color: blue;
    font-size: 20px;
    font-style: bold;
}
.white-box{
    color: black;
}
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-body">
                <span class="tieude">ROS - PROPOSAL</span>
                 
            </div>
        </div>
    </div>
</div>

<!-- /row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
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
            <form action="procurement/activity/add" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-body">
                    <div class="panel-group">
                    <div class="panel panel-info">
                        <div class="panel-heading">PLEASE INPUT INFOMATION</div>
                        <div class="panel-body">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tổng khối lượng dự án (m2)*</label>
                                    <input type="text" name="quantity" class="form-control" placeholder="Total Q'ty should from 10 000m2" value="{{ old('quantity') }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Độ dày (mm)</label>
                                    <input type="text" name="thickness" class="form-control form-control-danger" placeholder="Độ dày" value="{{ old('thickness') }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Chiều dài tối đa (m)*</label>
                                    <input type="text" name="length" class="form-control form-control-danger" placeholder="Chiều dài tối đa" value="{{ old('length') }}">
                                </div>
                            </div>
                            <!--/row-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Kiểu sóng*</label>
                                    <select class="form-control" name="procu_production_norm_id">
                                        <option>--Please select--</option>
                                        @foreach($products as $key=>$val)
                                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Địa điểm dự án*</label>
                                    <select class="form-control" name="proc_transportation_price_id">
                                        <option>--Please select--</option>
                                        @foreach($transports as $key=>$val)
                                            <option value="{{ $val->id }}">{{ $val->location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <label class="control-label">Điện công trường</label>
                                <select class="form-control" name="bl_electric_site">
                                        <option value="0">Không</option>
                                        <option value="1">Có</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Nhân công cung cấp bởi</label>
                                <select class="form-control" name="bl_operator_blv">
                                        <option value="0">Lysaght</option>
                                        <option value="1">Khách hàng</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Technician ?</label>
                                <select class="form-control" name="bl_technician">
                                        <option value="0">Không</option>
                                        <option value="1">Có</option>
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Số tấm/Kiện</label>
                                    <select class="form-control" name="pcs_per_packet">
                                        <option>Default</option>
                                        @for($i=1;$i<=20;$i++)
                                            <option value="{{$i}}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Số vị trí cán</label>
                                <select class="form-control" name="point_run_number">
                                    @for($i=1;$i<=10;$i++)
                                        <option value="{{$i}}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">Số vị trí đặt thành phẩm</label>
                                <select class="form-control" name="point_finishgood_number">
                                    @for($i=1;$i<=10;$i++)
                                        <option value="{{$i}}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Cán ở vị trí</label>
                                <select class="form-control" name="bl_layout_low">
                                    <option value="0">Thấp</option>
                                    <option value="1">Cao</option>
                                </select>
                            </div>
                            <div class="form-check-inline col-md-3" style="margin-top: 30px">
                                <input type="checkbox" class="check" id="minimal-checkbox-1" name="bl_mini_layout">
                                <label for="minimal-checkbox-1">Mặt bằng hạn chế</label>
                            </div>
                            


                            <div class="row"></div>
                            <div class="col-md-3" id="pac">
                                <label class="control-label">Phương án cẩu</label>
                                <select class="form-control" name="crane_option">
                                    <option value="0">Default</option>
                                    <option value="1">Hamer Liftjack</option>
                                    <option value="2">Liftjack</option>
                                    <option value="3">Minimum Cost</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>

                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Check</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="v2/member/js/jquery-1.12.4.min.js"></script>
<script src="v2/member/js/icheck/icheck.min.js"></script>
<script src="v2/member/js/icheck/icheck.init.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<script src="v2/member/js/jquery.min.js"></script>
<script type="text/javascript">
    $(".check").change(function() {
        if(this.checked) {
            document.getElementById("pac").innerHTML = `<input type="hidden" name="crane_option">`;
        }else{
            
            document.getElementById("pac").innerHTML = 
            `
                <label class="control-label">Phương án cẩu</label>
                <select class="form-control" name="crane_option">
                    <option value="0">Default</option>
                    <option value="1">Hamer Liftjack</option>
                    <option value="2">Liftjack</option>
                    <option value="3">Minimum Cost</option>
                </select>
            `
        }
    });



</script>

@endsection