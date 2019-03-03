<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="image/icon/congty.png"/>

    <title>BLUESCOPE LYSAGHT</title>
    <base href="{{asset('')}}">
    <!-- ===== Bootstrap CSS ===== -->
    <link href="v2/member/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <!-- ===== Animation CSS ===== -->
    <link href="v2/member/css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="v2/member/css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="v2/member/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')
</head>

<body class="mini-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- ===== Top-Navigation ===== -->
        @include('v2.member.layout.header')

        
        <!-- ===== Top-Navigation-End ===== -->
        <!-- ===== Left-Sidebar ===== -->
            @include('v2.member.layout.left_side')
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- Page Content -->
        
        <div class="page-wrapper">
            <div class="container-fluid">
                @yield('content')
                <!-- ===== Right-Sidebar ===== -->
                <!-- @include('v2.member.layout.footer') -->
                <!-- ===== Right-Sidebar-End ===== -->
            </div>
            <!-- /.container-fluid -->
            @include('v2.member.layout.footer')
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="v2/member/plugins/components/jquery/dist/jquery.min.js"></script>
    <script src="v2/member/js/jquery.min.js"></script>
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
    <!-- Footable -->
    <script src="v2/member/plugins/components/footable/js/footable.all.min.js"></script>
    <script src="v2/member/plugins/components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <!--FooTable init-->
    <script src="v2/member/plugins/components/jfootable/footable-init.js"></script>
    <!--Style Switcher -->
    <script src="v2/member/plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
    <!--Data table js -->
    <script src="v2/member/plugins/components/datatables/jquery.dataTables.min.js"></script>

    <!-- Flash notification -->
    <script src="js/flash_notification.js"></script>
    @yield('script')
</body>

</html>
