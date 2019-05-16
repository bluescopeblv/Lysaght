<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{{ $workcenter }} Machine</title>
    <link rel="shortcut icon" type="image/png" href="image/icon/congty.png"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <base href="{{asset('')}}">
    <!-- Bootstrap 3.3.4 -->
    <link href="delivery_inteface/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="delivery_inteface/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="delivery_inteface/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="delivery_inteface/css/thongtingiaohang.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .detail_CO{

        color: red;
      }

    </style>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <div class="img-logo">
        <a href="#">
          <img src="delivery_inteface/img/logo.png">
        </a>
        </div>
      </header>      
      <!-- Content Wrapper. Contains page content -->
      
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content content-table">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <p class="box-title">THÔNG TIN SẢN XUẤT / PRODUCTION INFORMATION == WORKCENTER: <span class="detail_CO">{{ $workcenter }}</span></p>
                  <p class="hour">Today {{date('d-M-Y')}}</p>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <thead>
                        <tr align="center" style="text-align: center;" >
                            <!-- <th>ID</th> -->
                            <th>Ngày SX</th>
                            <th>TT/Priority</th>
                            <th>Dự án/Project</th>
                            <th>CO</th>
                            <th>Type</th>
                            <th>LItem</th>
                            <th>Ngày giao hàng/Delivery date</th>
                            
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if(isset($kehoach))
                          <?php $i = 1; ?>
                          @foreach($kehoach as $kh)
                           
                          <tr class="odd gradeX" align="center" style="text-align: center;font-size: 25px ;
                                    @if($i == 1)
                                      color: green;
                                      font-weight: bold;
                                    @endif" >
                              <!-- <td>{{$kh->id}}</td> -->
                              <td>{{date('d-M-Y', strtotime($kh->DateSX_KH_DMY))}}</td>
                              <td>{{$kh->ThuTuCO}}</td>
                              <td>{{$kh->DuAn}}</td>
                              <td>{{$kh->CO}}</td>
                              <td>{{$kh->Type}}</td>
                              <td>{{$kh->Litem}}</td>
                              <td>{{$kh->NgayGH}}</td>
                              <td> </td>
                          </tr>
                          <?php $i = $i + 1; ?> 
                          
                          @endforeach
                      @endif
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->

         <!-- Main content -->
        <section class="content content-table">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                @if(isset($kehoach1))
                  <p class="box-title">CHI TIẾT ĐƠN HÀNG / ORDER DETAIL == 
                  CHI TIẾT CO: <span class="detail_CO " >{{$kehoach1->CO}} </span>  - LITEM: <span class="detail_CO " >{{$kehoach1->Litem}}</span> - NGÀY SẢN XUẤT: <span class="detail_CO " >{{date('d-M-Y', strtotime($kehoach1->DateSX_KH_DMY))}}</span> - THỨ TỰ CHẠY: <span class="detail_CO " >{{$kehoach1->ThuTuCO}}</span>
                  </p>

                  <p class="hour">Today {{date('d-M-Y')}}</p>
                @endif
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <thead>
                        <tr align="center" style="text-align: center;" >
                            <th hidden=""><input type="checkbox" id="checkbox"></th>

                                <th hidden="">ID</th>
                                <th>MO</th>
                                <th>Mark</th>
                                <!-- <th>Mô tả </th> -->
                                <th>Màu sắc</th>
                                <th>Citem</th>
                                <th>Số lượng</th>
                                <th>Chiều dài</th>
                                <!-- <th>Khối lượng</th> -->
                                <!--  <th>Priority</th> -->
                                <th>Note</th>
                                <th>Đã xong</th>
                                <th>SLSX</th>
                                <th hidden="">Feedback</th>
                                
                        </tr>
                    </thead>
                    <tbody>
                      @if(isset($chitietCO))
                          @foreach($chitietCO as $ct)
                          <tr class="odd gradeX" align="center" style="text-align: center;font-size: 20px" >
                              <td hidden=""><input type="checkbox" ></td>
                                  <td hidden="" id="id" class="id">{{$ct->id}}</td>
                                  <td>{{$ct->MO}}</td>
                                  <td>{{$ct->Mark}}</td>
                                  <!-- <td>{{str_replace("---","",str_replace("------","",$ct->DescriptionS))}}</td> -->
                                  <td>{{$ct->Color}}</td>
                                  <td>{{$ct->Citem}}</td>
                                  <td>{{$ct->SL}}</td>
                                  <td>{{number_format($ct->ChieuDai,0,"." , " ")}}</td>
                                  <!-- <td>{{number_format($ct->KL,4,"." , ",")}}</td> -->
                                  <!-- <td>{{$ct->Priority1}}</td> -->
                                  <td>{{$ct->Note1}}</td>

                                  @if($ct->DaSX2 == 1)
                                    <td style="color: green">{{"Sản xuất xong"}}</td>
                                  @elseif($ct->SLDaSX > 0)
                                    <td style="color: blue">{{"Đang sản xuất"}}</td>
                                  @else
                                    <td>{{"Chưa"}}</td>
                                  @endif
                                  <td>{{$ct->SLDaSX}}</td>
                                  <td hidden="">{{$ct->Note2}}</td>
                                  
                          </tr>
                          @endforeach
                      @endif
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <footer class="main-footer">
        <p>COPPYRIGHT 2019 @ALL RIGHT BY BLUESCOPE LYSAGHT VIETNAM</p>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
       
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="delivery_inteface/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="delivery_inteface/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="delivery_inteface/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="delivery_inteface/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="delivery_inteface/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="delivery_inteface/dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
