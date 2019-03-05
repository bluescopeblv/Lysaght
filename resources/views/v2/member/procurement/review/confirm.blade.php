@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- ===== Bootstrap CSS ===== -->
<link href="v2/member/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<!-- ===== Animation CSS ===== -->
<link href="v2/member/css/animate.css" rel="stylesheet">
<!-- ===== Custom CSS ===== -->
<link href="v2/member/css/style.css" rel="stylesheet">
<!-- ===== Color CSS ===== -->
<link href="v2/member/css/colors/default.css" id="theme" rel="stylesheet">

<link href="v2/member/footable/css/footable.bootstrap.min.css"    rel="stylesheet">

<!-- <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
.white-box{
    font-family: "Arial";
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

<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <div class="white-box printableArea">
            <h3><b>REVIEW Status: {!! getROS_status($activity->id) !!} </b> <span class="pull-right">#{{ $activity->id }}</span></h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <address>
                            <h3>VND &nbsp;<b class="text-danger" style="font-size: 40px;"> <span style="color: green; font-family: "arial" ">{{ number_format(getROS_TotalCost($activity)) }} </span></b></h3>
                            <p class="text-muted m-l-5">TỔNG GIÁ TRỊ DỰ ÁN
                                <br/> Số ngày cán tôn: {{ getROS_RunDay($activity) }}
                                <br/> Số nhân công: {{ number_format($detail_price->qty_labour) }}
                            </p>

                        </address>
                    </div>
                    <div class="pull-right text-right">
                        <address>
                            <h3>Sale,</h3>
                            <h4 class="font-bold">{{ $activity->users->name }}</h4>
                            <p class="text-muted m-l-30"> 
                                  {{ $activity->users->email  }},
                                  </p>
                            <p class="m-t-30"><b>Updated at :</b> <i class="fa fa-calendar"></i> {{ date('d-M-Y')}}</p>
                        </address>
                    </div>
                </div>

                <div class="col-md-12">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}           
                        </div>
                    @endif
                    <div class="white-box">
                        <div class="row line-steps">
                            <div class="col-md-4 column-step start">
                                <div class="step-number">1</div>
                                <div class="step-title">SUBMITED</div>
                                <div class="step-info">Submited</div>
                            </div>
                            <div class="col-md-4 column-step 
                                @if( $activity->status >= 1 )
                                    active
                                @endif">
                                <div class="step-number">2</div>
                                <div class="step-title">PENDING</div>
                                <div class="step-info">Pending</div>
                            </div>
                            <div class="col-md-4 column-step finish 
                                @if( $activity->status == 2 )
                                    active
                                @endif">
                                <div class="step-number">3</div>
                                <div class="step-title">REVIEWED</div>
                                <div class="step-info">Closed</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="table-responsive m-t-40" style="clear: both;">
                        <h3 style="color: blue">Các yêu cầu</h3>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Value</th>

                                    <th class="text-center">#</th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Tổng khối lượng</td>
                                    <td>m2</td>
                                    <td>{{ number_format($activity->quantity) }}</td>

                                    <td class="text-center">11</td>
                                    <td>Số vị trí đặt thành phẩm</td>
                                    <td>Vị trí</td>
                                    <td>{{ $activity->point_finishgood_number}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Độ dày</td>
                                    <td> mm </td>
                                    <td>{{ $activity->thickness }}</td>

                                    <td class="text-center">12</td>
                                    <td>Mặt bằng hạn chế</td>
                                    <td>-</td>
                                    <td>@if($activity->bl_mini_layout == 1)
                                            Có 
                                        @else
                                            Không
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Chiều dài tối đa</td>
                                    <td>m </td>
                                    <td>{{ $activity->length }}</td>

                                    <td class="text-center">13</td>
                                    <td>Phương án cẩu</td>
                                    <td>-</td>
                                    <td>@if($activity->crane_option == 0)
                                            Bình Thường 
                                        @elseif( $activity->crane_option == 1)
                                            Hamer Liftjack
                                        @elseif( $activity->crane_option == 2)
                                            Liftjack
                                        @else

                                        @endif</td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Kiểu sóng</td>
                                    <td></td>
                                    <td>{{ $activity->procu_production_norm->name }}</td>

                                    <td class="text-center">14</td>
                                    <td>Cán trên cao</td>
                                    <td>-</td>
                                    <td>@if($activity->bl_layout_low == 1)
                                            Có 
                                        @else
                                            Không
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>Địa điểm dự án</td>
                                    <td></td>
                                    <td>{{ $activity->proc_transportation_price->location }}</td>

                                    <td class="text-center">15</td>
                                    <td>Note</td>
                                    <td> </td>
                                    <td>{{ $activity->note }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">6</td>
                                    <td>Điện công trường</td>
                                    <td></td>
                                    <td>@if($activity->bl_electric_site == 1)
                                        Điện 
                                    @else
                                        Máy phát
                                    @endif</td>
                                </tr>
                                <tr>
                                    <td class="text-center">7</td>
                                    <td>Nhân công cung cấp bởi</td>
                                    <td></td>
                                    <td>@if($activity->bl_operator_blv == 1)
                                        Khách hàng 
                                    @else
                                        Lysaght
                                    @endif</td>
                                </tr>
                                <tr>
                                    <td class="text-center">8</td>
                                    <td>Technician</td>
                                    <td></td>
                                    <td>@if($activity->bl_technician == 1)
                                        Có 
                                    @else
                                        Không
                                    @endif</td>
                                </tr>
                                
                                <tr>
                                    <td class="text-center">9</td>
                                    <td>Số tấm/Kiện</td>
                                    <td>Tấm</td>
                                    <td>{{ $activity->pcs_per_packet}}</td>
                                </tr>
                                
                                <tr>
                                    <td class="text-center">10</td>
                                    <td>Số vị trí cán</td>
                                    <td>Vị trí</td>
                                    <td>{{ $activity->point_run_number }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title">GIÁ THÀNH PHẦN</h3>
                            <div class="table-responsive">
                                <table class="table color-bordered-table primary-bordered-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Description</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                    <td class="text-center">1</td>
                                    <td>Chi phí cẩu và vận chuyển</td>
                                    <td>VND</td>
                                    <td class="text-right">{{ number_format($detail_price->price_toiuu_crane)  }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Chi phí vận chuyển Accessories</td>
                                    <td>VND</td>
                                    <td class="text-right">{{ number_format($detail_price->price_transport_acc) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Chi phí bảo hiểm máy móc, thiết bị</td>
                                    <td>VND</td>
                                    <td class="text-right">{{ number_format($detail_price->price_machines_insurance) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Chi phí vận chuyển coil</td>
                                    <td>VND</td>
                                    <td class="text-right">{{ number_format($detail_price->price_transport_coil) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>Chi phí điện</td>
                                    <td>VND</td>
                                    <td class="text-right">{{ number_format($detail_price->price_electric) }}</td>
                                </tr>
                                
                                <tr>
                                    <td class="text-center">6</td>
                                    <td>Chi phí nhân công vận hành</td>
                                    <td>VND</td>
                                    <td class="text-right">{{ number_format($detail_price->price_labour) }}</td>

                                </tr>
                                <tr>
                                    <td class="text-center">7</td>
                                    <td>Chi phí kỹ thuật</td>
                                    <td>VND</td>
                                    <td class="text-right">{{ number_format($detail_price->price_technician) }}</td>
                                    
                                </tr>
                                <tr>
                                    <td class="text-center">8</td>
                                    <td>Chi phí gỗ/pallet</td>
                                    <td>VND</td>
                                    <td class="text-right">{{ number_format($detail_price->price_timber) }}</td>
                                    
                                </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                 <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title">GIÁ THÀNH PHẦN</h3>
                            <div class="table-responsive">
                                <table class="table color-bordered-table primary-bordered-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Description</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">9</td>
                                            <td>Chi phí dụng cụ an toàn, Vật tư...</td>
                                            <td>VND</td>
                                            <td class="text-right">{{ number_format($detail_price->price_safety_tool) }}</td>  
                                        </tr>
                                        <tr>
                                            <td class="text-center">10</td>
                                            <td>Chi phí bạc lót</td>
                                            <td>VND</td>
                                            <td class="text-right">{{ number_format($detail_price->price_covering_nylon) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">11</td>
                                            <td>Chi phí bảo vệ</td>
                                            <td>VND</td>
                                            <td class="text-right">{{ number_format($detail_price->price_security) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">12</td>
                                            <td>Chi phí phát sinh vị trí cán</td>
                                            <td>VND</td>
                                            <td class="text-right">{{ number_format($detail_price->price_point_run_number) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">13</td>
                                            <td>Chi phí phát sinh vị trí để thành phẩm</td>
                                            <td>VND</td>
                                            <td class="text-right">{{ number_format($detail_price->price_point_finishgood_number) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">14</td>
                                            <td>Chi phí dịch vụ</td>
                                            <td>VND</td>
                                            <td class="text-right">{{ number_format($detail_price->price_service) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <div class="col-md-12">
                    <div class="pull-right m-t-30 text-right">
                        <p>Sub - Total amount: {{ number_format(getROS_TotalCost($activity)) }}</p>
                        <p>vat (10%) : - </p>
                        <hr>
                        <h3><b style="font-size: 16px" >Total :  </b >{{ number_format(getROS_TotalCost($activity)) }} VND</h3></div>
                    <div class="clearfix"></div>


                    <hr>
                    <div class="row colorbox-group-widget">
                        <div class="col-md-3 col-sm-6 info-color-box">
                            <div class="white-box">
                                <div class="media bg-primary">
                                    <div class="media-body">
                                        <h3 class="info-count">{{getROS_Weigh($activity)}} <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
                                        <p class="info-text font-12">TẤN</p>
                                        <p class="info-ot font-15">---<span class="label label-rounded"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 info-color-box">
                            <div class="white-box">
                                <div class="media bg-success">
                                    <div class="media-body">
                                        <h3 class="info-count">{{ getROS_RunDay($activity) }} <span class="pull-right"><i class="mdi mdi-comment-text-outline"></i></span></h3>
                                        <p class="info-text font-12">SỐ NGÀY CÁN TÔN DỰ KIẾN</p>
                                        <p class="info-ot font-15">Đã bao gồm ngày Setup & Packup <span class="label label-rounded"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-6 info-color-box">
                            <div class="white-box">
                                <div class="media bg-warning">
                                    <div class="media-body">
                                        <h3 class="info-count">VND {{number_format(getROS_TotalCost($activity))}} <span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>
                                        <p class="info-text font-12">Total Price</p>
                                        <p class="info-ot font-15">Giá chưa bao gồm VAT<span class="label label-rounded"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row"></div>
                            

                            <div class="col-md-4">
                                <div class="form-group has-danger" style="background-color: rgba(255, 102, 0, 1) ;padding: 10px 20px 10px 20px; border-radius: 15px;color: white; ">
                                    <span style="font-size: 20px;" >MẶT BẰNG DÀI </span>
                                    <BR/>
                                    a = <span style="font-size: 40px;text-align: center;" > {{ $activity->a }} </span> m
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-danger" style="background-color: rgba(255, 102, 0, 1) ;padding: 10px 20px 10px 20px; border-radius: 15px;color: white; ">
                                    <span style="font-size: 20px;" >MẶT BẰNG RỘNG </span>
                                    <BR/>
                                    b = <span style="font-size: 40px;text-align: center;" > {{ $activity->b }} </span> m
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-danger" style="background-color: rgba(255, 102, 0, 1) ;padding: 10px 20px 10px 20px; border-radius: 15px;color: white; ">
                                    <span style="font-size: 20px;" >KV THÀNH PHẨM </span>
                                    <BR/>
                                    L = <span style="font-size: 40px;text-align: center;" > {{ $activity->L }} </span> m
                                    <br>
                                </div>
                            </div>

                            <div class="col-md-12">
                                @if($activity->bl_mini_layout == "on") 
                                    <img src="upload/ros/layout_save.png">
                                @else
                                    <img src="upload/ros/layout_large.png">
                                @endif
                            </div>
                    <div class="row"></div>
                    <hr>
                    <form action="procurement/review/confirm/{{$activity->id}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class=" col-md-1">
                            <label class="control-label">Note</label>
                        </div>

                        <div class=" col-md-3">
                            
                            <input type="text" name="note" class="form-control form-control-danger" placeholder="Write your note ..." value="{{ old('note') }}">
                        </div>    
                        <div class="col-md-1">
                            <button class="btn btn-success" type="submit"> Approve </button>
                        </div>
                    </form>
                    <span>   </span>

                    <form action="procurement/review/noagree/{{$activity->id}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="col-md-1">

                        </div>
                        <div class=" col-md-3" style="text-align: right;">
                            
                            <input type="text" name="note" class="form-control form-control-danger" placeholder="Write your note ..." value="{{ old('note') }}">
                        </div>
                        <div class=" col-md-1">
                            <button class="btn btn-danger" type="submit"> Not Agree </button>
                            <!-- <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>


        

    </div>

    

</div>





@endsection

@section('script')
<!-- Menu Plugin JavaScript -->
<script src="v2/member/js/sidebarmenu.js"></script>
<!--slimscroll JavaScript -->
<script src="v2/member/js/jquery.slimscroll.js"></script>
<script src="v2/member/js/custom.js"></script>
<!-- Bootstrap Core JavaScript -->
    <script src="v2/member/bootstrap/dist/js/bootstrap.min.js"></script>
<!--Wave Effects -->
<script src="v2/member/js/waves.js"></script>
<!-- jQuery -->
<script src="v2/member/js/jquery/dist/jquery.min.js"></script>
<script src="v2/member/js/bootstrap-table/dist/bootstrap-table.min.js"></script>
<script src="v2/member/js/bootstrap-table/dist/bootstrap-table.ints.js"></script>
<!-- jQuery -->
<script src="v2/member/plugins/components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="v2/member/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="v2/member/js/sidebarmenu.js"></script>
<!--slimscroll JavaScript -->
<script src="v2/member/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="v2/member/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="v2/member/js/custom.js"></script>
<script src="v2/member/plugins/components/bootstrap-table/dist/bootstrap-table.min.js"></script>
<script src="v2/member/plugins/components/bootstrap-table/dist/bootstrap-table.ints.js"></script>
<!--Style Switcher -->
<script src="v2/member/plugins/components/styleswitcher/jQuery.style.switcher.js"></script>

<!--Footable -->
<script src="v2/member/footable/js/footable.js"></script>
<script src="v2/member/footable/js/footable.min.js"></script>
@endsection