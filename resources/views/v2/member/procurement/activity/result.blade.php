@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

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
                <span class="tieude">ROS - RESULT - ESTIMATED PRICE</span>
                <span style="float:right; display: block">
                <a href="procurement/activity/firstcheck">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Check another </button></a></span>
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
            <form action="procurement/activity/review" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                
                <input type="hidden" name="quantity" value="{{ $request->quantity }}">
                <input type="hidden" name="thickness" value="{{ $request->thickness }}">
                <input type="hidden" name="length" value="{{ $request->length }}">
                <input type="hidden" name="procu_production_norm_id" value="{{ $request->procu_production_norm_id }}">
                <input type="hidden" name="proc_transportation_price_id" value="{{ $request->proc_transportation_price_id }}">
                <input type="hidden" name="bl_electric_site" value="{{ $request->bl_electric_site }}">
                <input type="hidden" name="bl_operator_blv" value="{{ $request->bl_operator_blv }}">
                <input type="hidden" name="bl_technician" value="{{ $request->bl_technician }}">
                <input type="hidden" name="bl_layout_low" value="{{ $request->bl_layout_low }}">
                <input type="hidden" name="a" value="{{ $request->a }}">
                <input type="hidden" name="b" value="{{ $request->b }}">
                <input type="hidden" name="L" value="{{ $request->L }}">
                <input type="hidden" name="totalcost" value="{{ $request->totalcost }}">

                <input type="hidden" name="pcs_per_packet" value="{{ $request->pcs_per_packet }}">
                <input type="hidden" name="point_run_number" value="{{ $request->point_run_number  }}">
                <input type="hidden" name="point_finishgood_number" value="{{ $request->point_finishgood_number }}">
                <input type="hidden" name="bl_mini_layout" value="{{ $request->bl_mini_layout  }}">
                <input type="hidden" name="crane_option" value="{{ $request->crane_option  }}">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="price_include_service" value="{{ $price_include_service }}">
                <input type="hidden" name="detail_price" value="{{ $js_detail_price }}">
                 

                <div class="form-body">
                    <div class="panel-group">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            
                            <div class="col-md-7">
                                <div class="form-group has-danger" style="background-color: rgba(0, 102, 0, 1) ;padding: 10px 20px 10px 20px; border-radius: 15px;color: white; ">
                                    <span style="font-size: 20px;" >TỔNG GIÁ TRỊ DỰ ÁN </span>
                                    <BR/>
                                    VND<span style="font-size: 50px;" ><b> {{ number_format($price_include_service,0) }}</b> </span>
                                    <br/><br/>
                                </div>
                            </div>



                            <div class="col-md-5">
                                <div class="form-group has-danger" style="background-color: rgba(0, 102, 0, 1) ;padding: 10px 20px 10px 20px; border-radius: 15px;color: white; ">
                                    <span style="font-size: 20px;" >THỜI GIAN DỰ KIẾN </span>
                                    <BR/>
                                    <span style="font-size: 40px;text-align: center;" > {{ number_format($run_day + 2,0) }} </span> NGÀY (Số nhân công: {{ number_format($qty_labour) }} người )
                                    <br/>

                                    <p>Đã bao gồm 1 ngày setup & 1 ngày thu dọn</p> 
                                </div>
                            </div>
                            <div class="row"></div>
                            

                            <div class="col-md-4">
                                <div class="form-group has-danger" style="background-color: rgba(255, 102, 0, 1) ;padding: 10px 20px 10px 20px; border-radius: 15px;color: white; ">
                                    <span style="font-size: 20px;" >MẶT BẰNG DÀI </span>
                                    <BR/>
                                    a = <span style="font-size: 40px;text-align: center;" > {{ $a }} </span> m
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-danger" style="background-color: rgba(255, 102, 0, 1) ;padding: 10px 20px 10px 20px; border-radius: 15px;color: white; ">
                                    <span style="font-size: 20px;" >MẶT BẰNG RỘNG </span>
                                    <BR/>
                                    b = <span style="font-size: 40px;text-align: center;" > {{ $b }} </span> m
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-danger" style="background-color: rgba(255, 102, 0, 1) ;padding: 10px 20px 10px 20px; border-radius: 15px;color: white; ">
                                    <span style="font-size: 20px;" >KV THÀNH PHẨM </span>
                                    <BR/>
                                    L = <span style="font-size: 40px;text-align: center;" > {{ $L }} </span> m
                                    <br>
                                </div>
                            </div>

                            <div class="col-md-12">
                                @if($request->bl_mini_layout == "on") 
                                    <img src="upload/ros/layout_save.png">
                                    <img src="upload/ros/layout_3D.png">
                                @else
                                    <img src="upload/ros/layout_large.png">
                                    <img src="upload/ros/layout_3D.png">
                                @endif
                            </div>
    
                        </div>
                    </div>

                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Send Procurement Review</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')


@endsection