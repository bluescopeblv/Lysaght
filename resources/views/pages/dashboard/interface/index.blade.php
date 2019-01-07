<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BLUESCOPE LYSAGHT</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <base href="{{asset('')}}">
    <!-- Bootstrap 3.3.4 -->
    <link href="delivery_inteface/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="delivery_inteface/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="delivery_inteface/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="delivery_inteface/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="delivery_inteface/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" type="text/css" href="delivery_inteface/css/dashboard.css"> -->
    <link rel="stylesheet" type="text/css" href="delivery_inteface/css_fix/dashboard.css">

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
        <div class="img-logo col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
        <a href="#">
          <img src="delivery_inteface/img/logo.png">
        </a>
        </div>
        <div class="img-language col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <img src="delivery_inteface/img/language_english.png">
        </div><!-- ./img-language -->
      </header>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="row1">
          <div id="chartContainer" class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin: 0px auto;"></div>
          <div id="ytd" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <!-- chart circle -->
            <div id="piechart"></div>
            <!-- end chart circle -->
            <div id="multiskill">
              <p class="title">Multi-skill</p>
              <div class="multiskill-content">
                <div class="target">
                  <p class="percent">70%</p><!-- ./percent -->
                  <p class="text-target">Target</p>
                </div><!-- ./target -->
                <div class="actual">
                  <p class="percent">60%</p><!-- ./percent -->
                  <p class="text-target">Actual</p>
                </div><!-- ./actual -->
              </div><!-- ./multiskill-content -->
            </div><!-- #multiskill -->
          </div><!-- #ytd -->
          <div id="chartLU" class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin: 0px auto;"></div>
        </section><!-- ./content-area -->
       <section class="row2">
        <div class="dlt-cod col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
         <div id="dlt" >
            <p class="name-title">Dispatch lead-time </p>
           <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <p class="percent">6</p>
              <p class="text-minpack">min/ pack</p>
              <p class="text-target">Target</p>
            </div><!-- ./target -->
            <div class="actual col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <p class="percent">6</p>
              <p class="text-minpack">min/ pack</p>
              <p class="text-target">Actual</p>
            </div><!-- ./actual -->
         </div><!-- #/dlt -->
         <div id="cod">
            <p class="name-title">Cost of defect</p>
           <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <p class="percent">0.03</p>
              <p class="text-target">Target</p>
            </div><!-- ./target -->
            <div class="actual col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <p class="percent">0.02</p>
              <p class="text-target">Actual</p>
            </div><!-- ./actual -->
         </div><!-- #/cod -->
         </div><!-- ./dlt-cod -->
         <div id="record_revenue" class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
         <div id="backlog" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class=" box-backlog col-lg-12">
          <p class="name-title">Backlog</p>
           <div class="col-left">
             <p class="percent">80</p>
             <p class="text-target">tấn</p>
             <p class="text-target">ACTUAL</p>
           </div><!-- ./col-left -->
           <div class="col-right">
             <p>Finish good<span>40</span></p>
             <p>Remain<span class="spannth2">30</span></p>
           </div><!-- ./col-right -->
           </div>
         </div><!-- #backlog -->
       </section><!-- ./row2 -->
       <section class="row3">
         <div class="hr-deliveryservice col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
         <div id="hr" >
            <p class="name-title">Hr</p>
           <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <p class="percent">{{$hr->total_employees - $hr->female_employees }}</p>
              <p class="text-minpack">{{ number_format(($hr->total_employees - $hr->female_employees)*100 / $hr->total_employees,1) }}%</p>
              <div>
                <img src="delivery_inteface/img/ic_men.png">
              </div>
              <p class="text-target">Men</p>
            </div><!-- ./target -->
            <div class="actual col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <p class="percent">{{ $hr->female_employees }}</p>
              <p class="text-minpack">{{ number_format($hr->female_employees*100 / $hr->total_employees,1) }}%</p>
              <div>
                <img src="delivery_inteface/img/ic_women.png">
              </div>
              <p class="text-target">women</p>
            </div><!-- ./actual -->
         </div><!-- #/dlt -->
         <div id="delivery">
            <p class="name-title">Delivery service</p>
           <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <p class="percent">120</p>
              <p class="money">tỷ</p>
              <p class="text-target">Target</p>
            </div><!-- ./target -->
            <div class="actual col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <p class="percent">150</p>
              <p class="money">tỷ</p>
              <p class="text-target">Actual</p>
            </div><!-- ./actual -->
         </div><!-- #/cod -->
         </div><!-- ./hr-deliveryservice -->
         <div class="losttimeinjury-medical col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
         <div id="losttimeinjury">
            <p class="name-title">Lost Time Injury</p>
           <div class="target">
              <p class="percent">{{ number_format(get_DS_Safety_Date_LTI($safety->LTI)) }}</p>
              <p class="text-minpack">days</p>
              <div>
                <img src="delivery_inteface/img/ic_hour.png">
              </div>
              <p class="text-target">Last {{ date('d-m-Y',strtotime($safety->LTI))}}</p>
            </div><!-- ./target -->
         </div><!-- #/losttimeinjury -->
         <div id="medical">
            <p class="name-title">Medical Treatment Incident</p>
           <div class="target">
              <p class="percent">{{ number_format(get_DS_Safety_Date_MTI($safety->MTI)) }}</p>
              <p class="money">days</p>
              <div>
                <img src="delivery_inteface/img/ic_hour.png">
              </div>
              <p class="text-target">Last {{ date('d-m-Y',strtotime($safety->MTI))}}</p>
            </div><!-- ./target -->
         </div><!-- #/medical -->
         </div><!-- ./losttimeinjury-medical -->

         <div class="actualdelivery-customercomplant col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
         <div id="actual_delivery">
            <p class="name-title">Actual delivery </p>
            <div class="box-row1">
            <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <p class="percent">40</p>
              <p class="text-minpack">tỷ</p>
            </div><!-- ./target -->
            <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <p class="percent">40</p>
              <p class="text-minpack">tỷ</p>
            </div><!-- ./target -->
            </div>
            <div class="icon-center">
                <img src="delivery_inteface/img/ic_money.png">
              </div>
              
            <div class="box-row1">
            <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <p class="text-target">Target</p>
            </div><!-- ./target -->
            <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <p class="text-target">Actual</p>
            </div><!-- ./target -->
            </div>
         </div><!-- #/losttimeinjury -->
         <div id="customer_complant">
            <p class="name-title">Customer complaint</p>
            <div class="box-row1">
            <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <p class="percent">000</p>
            </div><!-- ./target -->
            <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <p class="percent">002</p>
            </div><!-- ./target -->
            </div>
            <div class="icon-center">
                <img src="delivery_inteface/img/ic_face.png">
              </div>
             <div class="box-row1">
            <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <p class="text-target">Target</p>
            </div><!-- ./target -->
            <div class="target col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <p class="text-target">Actual</p>
            </div><!-- ./target -->
            </div>
         </div><!-- #/medical -->
         </div><!-- ./actualdelivery-customercomplant -->

       </section><!-- ./row3 -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <p>COPPYRIGHT 2018 @ALL RIGHT BY BLUESCOPE LYSAGHT</p>
      </footer>
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
    <script src="delivery_inteface/plugins/chartjs/canvasjs.min.js" type="text/javascript"></script>
    <!-- chart circle -->
    <script type="text/javascript" src="delivery_inteface/js/loader.js"></script>
    <script src="delivery_inteface/js/script.js" type="text/javascript"></script>
  </body>
</html>
