<!DOCTYPE html>
<html>
<head>

	<title>PROPOSAL</title>
	<meta charset="UTF-8">
	<link rel="shortcut icon" type="image/png" href="image/icon/congty.png"/>
    <!-- Latest compiled and minified CSS -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
	<style>
		#customers {
		  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		}

		#customers td, #customers th {
		  border: 1px solid #ddd;
		  padding: 1px;
		}

		#customers tr:nth-child(even){background-color: #f2f2f2;}

		#customers tr:hover {background-color: #ddd;}

		#customers th {
		  padding-top: 1px;
		  padding-bottom: 1px;
		  text-align: left;
		  background-color: #4CAF50;
		  color: white;
		}

		.rcorners2 {
		  display: inline-block;
		  border-radius: 25px;
		  border: 2px solid #73AD21;
		  padding: 20px; 
		  width: 196px;
		  height: 110px;  
		  margin-right: 2px;
		}

		/** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 1cm;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 0.5cm;
            }
	</style>

</head>
<body>
	<div class="row">
		<div  >
			<img src="image\icon\congty.png" width="60px" >
			<h4 style="color: blue; text-align: right; display: inline; float: right;">
			NS BLUESCOPE LYSAGHT VIETNAM</h4>
		</div>

	</div>
	<div class="row">
		

	    <div class="col-md-12">
	        <div class="white-box printableArea">
	            <h3 style="text-align: left;"><span>Project Name:_______________________________________________________  </span> <span>No.#{{ $activity->id }}</span></h3>
	            <hr>
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="pull-left" style="float: left">
	                        <address>
	                            <h3>VND &nbsp;<b class="text-danger" style="font-size: 40px;"> <span style="color: green; font-family: "arial" ">{{ number_format(getROS_TotalCost($activity)) }} </span></b></h3>
	                            <p class="text-muted m-l-5" style="font-family: arial ">TỔNG GIÁ TRỊ DỰ ÁN
	                                <br/> Số ngày cán tôn: {{ getROS_RunDay($activity) }}
	                            </p>

	                        </address>
	                    </div>
	                    <div class="pull-right text-right" style="float: right; display: inline;">
	                        <address>
	                            <h3>Sale,</h3>
	                            <h4 class="font-bold">{{ Auth::user()->name }}</h4>
	                            <p class="text-muted m-l-30"> 
	                                  {{Auth::user()->email  }},
	                                  </p>
	                            <p class="m-t-30"><b>Updated at :</b> <i class="fa fa-calendar"></i> {{ date('d-M-Y')}}</p>
	                        </address>
	                    </div>
	                </div>
	                
	                <div class="col-md-12"  style="font-family: arial;">
	                    <div class="table-responsive m-t-40" style="clear: both;">
	                        <table class="table table-hover" id="customers">
	                            <thead>
	                                <tr>
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
	                                </tr>
	                                <tr>
	                                    <td class="text-center">2</td>
	                                    <td>Độ dày</td>
	                                    <td> mm </td>
	                                    <td>{{ $activity->thickness }}</td>
	                                </tr>
	                                <tr>
	                                    <td class="text-center">3</td>
	                                    <td>Chiều dài tối đa</td>
	                                    <td>m </td>
	                                    <td>{{ $activity->length }}</td>
	                                </tr>
	                                <tr>
	                                    <td class="text-center">4</td>
	                                    <td>Kiểu sóng</td>
	                                    <td></td>
	                                    <td>{{ $activity->procu_production_norm->name }}</td>
	                                </tr>
	                                <tr>
	                                    <td class="text-center">5</td>
	                                    <td>Địa điểm dự án</td>
	                                    <td></td>
	                                    <td>{{ $activity->proc_transportation_price->location }}</td>
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
	                                <tr>
	                                    <td class="text-center">11</td>
	                                    <td>Số vị trí đặt thành phẩm</td>
	                                    <td>Vị trí</td>
	                                    <td>{{ $activity->point_finishgood_number}}</td>
	                                </tr>
	                                <tr>
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
	                                    <td class="text-center">15</td>
	                                    <td>Note from Procurement</td>
	                                    <td> </td>
	                                    <td>{{ $activity->note }}</td>
	                                </tr>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	                <div class="col-md-12" >
	                    <div class="pull-right m-t-30 text-right" style="text-align: right;">
	                        <p>Sub - Total amount: {{ number_format(getROS_TotalCost($activity)) }}</p>
	                        <p>vat (10%) : - </p>
	                        <hr>
	                        <h3><b style="font-size: 16px" >Total :  </b >{{ number_format(getROS_TotalCost($activity)) }} VND</h3></div>
	                        <br><br>
	                        <div style="clear: all"></div>
	                </div>
	                <div class="col-md-12" style="font-family: arial;">

	                    <div class="rcorners2" style="float: left;">
                            <h3 class="info-count">{{number_format(getROS_Weigh($activity), 1) }} TẤN</h3>
                            <p class="info-text font-12">KHỐI LƯỢNG</p>

                        </div>

                        <div class="rcorners2" style="display: inline-block;clear: all; float: center">
                            <h3 class="info-count">{{ getROS_RunDay($activity)  }} <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
                            <p class="info-text font-12">SỐ NGÀY CÁN TÔN</p>
                            <p style="font-size: 10px">Đã bao gồm ngày Setup & Packup <span class="label label-rounded"></span></p>
                        </div>

                        <div class="rcorners2" style="clear: all; float: right; clear: all">
                            <h3 class="info-count">VND {{number_format(getROS_TotalCost($activity))}} <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
                            <p class="info-text font-12">Total Price</p>
                        </div>
                        <div style="clear: all"></div>
                    </div>
                </div>

                <div class="row" style="font-family: arial">
                            
                    <div class="col-md-4" style="padding-top: 170px">
                        <div class="form-group has-danger" style="background-color: rgba(255, 255, 0, 0.4) ;padding: 10px 20px 10px 20px; border-radius: 15px;color: blue; ">
                            <span style="font-size: 20px;" >CHI TIẾT MẶT BẰNG </span>
                            <br/>
                            a = <span style="font-size: 40px;text-align: center; color: red" > {{ $activity->a }}</span> (m); 
                            b = <span style="font-size: 40px;text-align: center; color: red" > {{ $activity->b }} </span>(m); 
                            L = <span style="font-size: 40px;text-align: center; color: red" > {{ $activity->L }} </span>m

                        </div>
                    </div>
                    <br>
                    <br>

                            <div class="col-md-12" style="text-align: center;">
                                @if($activity->bl_mini_layout == "on") 
                                    <img src="upload/ros/layout_save.png" width="90%">
                                    <img src="upload/ros/layout_3D.png" width="70%">
                                @else
                                    <img src="upload/ros/layout_large.png" width="90%">
                                    <img src="upload/ros/layout_3D.png" width="70%">
                                @endif
                            </div>
                            <div class="col-md-12" style="text-align: center;">
                                <span >Noted: Áp dụng cho điều kiện cầu đường lớn hơn 42 tấn.</span> 
                            </div>

                    <div class="text-right">
                        <!-- <button class="btn btn-danger" type="submit"> Proceed to payment </button>
                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button> -->
                    </div>
                </div>
	        </div>

	    </div>
	</div>
	<footer>
            Copyright &copy; <?php echo date("Y");?>  NS BLUESCOPE LYSAGHT VIETNAM
   	</footer>
</body>
</html>