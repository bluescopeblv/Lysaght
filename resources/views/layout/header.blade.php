    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="trangchu">BLUESCOPE</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    @if(Auth::user())
                        @if(Auth::user()->quyen_preL3)
                    <li><a href="kehoach">Kế hoạch</a></li>
                    <li><a href="feedback">Phản hồi @if($sl > 0)<span style="color: yellow" class="glyphicon glyphicon-bell">{{$sl}}</span>@endif</a></li>
                        @endif
                        @if(Auth::user()->quyen_5s)
                            <li><a href="fives/">5S</a></li>
                        @endif
                        @if(Auth::user()->quyen_baotri)
                            <li><a href="maintenance">Bảo trì</a></li>
                        @endif
                        @if(Auth::user()->quyen_delivery)
                            <li><a href="delivery">Giao hàng</a></li>
                        @endif
                        @if(Auth::user()->quyen_activity)
                            <li><a href="activity">Hoạt động</a></li>
                        @endif
                        @if(Auth::user()->ver == 2)
                            <li><a href="member">v2</a></li>
                        @endif
                    
                    @endif
                    <li><a href="baoloi-danhsach">Báo lỗi</a></li>
                    <li><a href="phonebook">Danh bạ</a></li>
                    <!-- <li><a href="lienhe">Liên hệ</a></li> -->
                </ul>

			    <ul class="nav navbar-nav pull-right">
                    @if(!Auth::user())
                        <li>
                            <a href="dangky">Đăng ký</a>
                        </li>
                        <li>
                            <a href="dangnhap">Đăng nhập</a>
                        </li>
                    @else
                        <li>
                        	<a href="nguoidung">
                        		<span class ="glyphicon glyphicon-user"></span>{{Auth::user()->name}}
                        	</a>
                        </li>
                        <li>
                            <a style="color: yellow">
                                <span  class ="glyphicon glyphicon-globe"> </span>{{Auth::user()->workcenter}}
                            </a>
                        </li>
                        <li>
                        	<a href="dangxuat">Đăng xuất</a>
                        </li>
                    @endif
                    
                </ul>
            </div>


            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>