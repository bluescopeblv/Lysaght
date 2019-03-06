@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
#myTable{
    font-family: "Arial";
    color: black;
    font-size: 12px;
}

myTable.tbody{
    color: black;
    font-size: 10px;
}

.tieude{
    font-family: "Arial";
    color: blue;
    font-size: 20px;
    font-style: bold;
}
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-body">
                <span class="tieude">ROS - REVIEW</span>
                <span style="float:right; display: block">
                <!-- <a href="procurement/product/add">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Thêm sản phẩm mới </button></a></span> -->
            </div>
        </div>
    </div>
</div>

<!-- /row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0"></h3>
                <!--  <p class="text-muted m-b-30">Data table example</p>-->            
                <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-striped color-bordered-table info-bordered-table hover-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tổng khối lượng (m2)</th>
                            <th>Độ dày (mm)</th>
                            <th>Chiều dài tối đa (m)</th>
                            <th>Kiểu sóng</th>
                            <th>Địa điểm dự án</th>
                            <th>Điện công trường</th>
                            <th>Nhân công cung cấp bởi</th>
                            <th>Technician </th>
                            <th>Số tấm/Kiện</th>
                            <!-- <th>Số vị trí cán</th>
                            <th>Số vị trí đặt thành phẩm</th> -->
                            <th>Mặt bằng hạn chế</th>
                            <th>Phương án cẩu</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($activities as $key=>$val)
                        <tr>
                            <td>{{ $val->id }}</td>
                            <td>{{ number_format($val->quantity) }}</td>

                            <td>{{ $val->thickness }}</td>
                            <td>{{ $val->length }}</td>
                            <td>{{ $val->procu_production_norm->name  }}</td>
                            <td>{{ $val->proc_transportation_price->location }}</td>
                            <td>@if($val->bl_electric_site == 1)
                                    Điện 
                                @else
                                    Máy phát
                                @endif</td>
                            <td>@if($val->bl_operator_blv == 1)
                                    Khách hàng 
                                @else
                                    Lysaght
                                @endif</td>
                            <td>@if($val->bl_technician == 1)
                                    Có 
                                @else
                                    Không
                                @endif</td>

                            <td>{{ $val->pcs_per_packet}}</td>
                            <!-- <td>{{ $val->point_run_number  }}</td>
                            <td>{{ $val->point_finishgood_number }}</td> -->
                            
                            <td>@if($val->bl_mini_layout == 1)
                                    Có 
                                @else
                                    Không
                                @endif
                            </td>

                            <td>@if($val->crane_option == 0)
                                    Bình Thường 
                                @elseif( $val->crane_option == 1)
                                    Hamer Liftjack
                                @elseif( $val->crane_option == 2)
                                    Liftjack
                                @else

                                @endif</td>
                            <td>{{ $val->note }}</td>
                            <td>{!! getROS_status($val->id) !!}</td>

                            <td>
                                <span class="label label-warning">
                                    <a href="procurement/review/edit/{{$val->id}}"><span class="glyphicon glyphicon-edit">Xem</span></a>
                                </span>
                            </td>
                            <td>
                                <span class="label label-warning">
                                    <a href="procurement/review/export/{{$val->id}}"><span class="glyphicon glyphicon-edit">Print</span></a>
                                </span>
                                
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
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
             
            "displayLength": 15,
            "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
             
        });
         
    });
});



</script>
@endsection