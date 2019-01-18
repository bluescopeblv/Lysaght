<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BLUESCOPE LYSAGHT</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <base href="{{asset('')}}">
    <link rel="shortcut icon" type="image/png" href="image/icon/congty.png"/>

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
    <link rel="stylesheet" type="text/css" href="delivery_inteface/css_fix/thongtingiaohang.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
        <section class="content-area">
      <div class="box box-1">
        <p class="text-title">Khu vực xe chờ giao hàng</p>
        <div class="thumb-box">
          <div class="content-thumb-box">                 
          @foreach($thongtinxe as $ttx)
          @if($ttx->status >= 20 & $ttx->status <= 30 )
            <div class="item">
              <div class="box-item">
                <div class="img-truck">
                    <img src="delivery_inteface/img/truck.png">
                </div>
                <p class="text-number-truck">{{$ttx->bienso}}</p>
                <div class="text-time">
                  <p>
                    @if($ttx->thoigianxevao != NULL)
                      {{ date('H:i',strtotime($ttx->thoigianxevao)) }}
                    @endif
                    
                  </p>
                  <p>{{ get_Delivery_Minute($ttx->thoigianxevao) }} phút</p>
                </div>
              </div><!-- ./box-item -->
            </div><!-- ./item -->
          @endif
          @endforeach
            <div class="item" style="background: white">
              <div class="box-item" style="background: white">
                <div class="img-truck">
                    
                </div>
                <p class="text-number-truck"></p>
                <div class="text-time">
                  <p>
                    
                    
                  </p>
                  <p></p>
                </div>
              </div><!-- ./box-item -->
            </div><!-- ./item -->

          </div><!-- ./content-thumb-box-1 -->
        </div><!-- ./thumb-box-1 -->
      </div><!-- ./box-1 -->
      <div class="box box-2">
        <p class="text-title">Khu vực giao hàng</p>
          <div class="thumb-box">
            <div class="content-thumb-box">
            @foreach($thongtinxe as $ttx)
            @if($ttx->status >= 40 & $ttx->status <= 60 )
            <div class="item">
              <div class="box-item">
                <div class="img-truck">
                    <img src="delivery_inteface/img/truck.png">
                </div>
              <p class="text-number-truck">{{$ttx->bienso}}</p>
              <div class="text-time">
                <p>@if($ttx->thoigianxevao != NULL)
                      {{ date('H:i',strtotime($ttx->thoigianxevao)) }}
                    @endif</p>
                <p>{{ get_Delivery_Minute($ttx->thoigianxevao) }} phút</p>
              </div>
            </div>
            </div><!-- ./item -->
            @endif
            @endforeach
            <div class="item">
              <div class="box-item" style="background:white">
                

              </div>
            </div><!-- ./item -->
          </div>
        </div>
      </div><!-- ./box-2 -->
         
          
        </section><!-- ./content-area -->
        <section class="content content-table">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <p class="box-title">Thông tin giao hàng</p>
                  <p class="hour">{{ date('d-M-Y') }}</p>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Kế hoạch</th>
                      <th>Xe vào</th>
                      <th>Khách hàng</th>
                      <th>Biển số</th>
                      <th>Trọng tải xe</th>
                      <th>Số CO</th>
                      
                      <th>Trạng thái</th>
                      <th>DN</th>
                      <th>Chi tiết</th>
                    </tr>
                    @foreach($thongtinxe as $ttx)
                    <tr>
                        <td>
                            @if($ttx->thoigiankehoach == NULL)

                            @else
                            <span><i class="fa fa-clock-o"></i> {{ date('d-m-Y H:i',strtotime($ttx->thoigiankehoach)) }}</span>
                            @endif
                        </td>
                        <td>
                            @if($ttx->thoigianxevao == NULL)

                            @else
                            <span><i class="fa fa-clock-o"></i> {{ date('H:i',strtotime($ttx->thoigianxevao)) }}</span>
                            @endif
                        </td>
                        <td>
                            <span class="">{{ $ttx->khachhang }}</span>
                        </td>
                        <td>
                            <span class=""><i class="fa fa-car"></i> {{ $ttx->bienso }}</span>
                        </td>
                        <td>{{$ttx->taitrongxe}} Tấn</td>
                        <td> 
                            <a href="delivery/logistic/detailco/{{$ttx->id}}">{{ getSoLuongCO($ttx->id) }}</a> 
                        </td>
                        

                        <!-- <td>
                            <div class="label label-table label-success">Paid</div>
                        </td> -->
                        <td>
                            {!! getDeliveryStatus($ttx->status) !!}
                        </td>
                        <td>
                          @if($ttx->thoigianxongDN)
                            <span class="label label-warning">Đã có DN</span>
                          @endif
                        </td>
                        <td>{{ $ttx->notelogistic }}</td>
                    </tr>
                    @endforeach
                    
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <p>COPPYRIGHT 2018 @ALL RIGHT BY BLUESCOPE LYSAGHT VIETNAM</p>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right" />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
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
