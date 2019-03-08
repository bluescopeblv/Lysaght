<aside class="sidebar" role="navigation">
    <div class="scroll-sidebar">
        <div class="user-profile">
            @if(Auth::check())
            <div class="dropdown user-pro-body">
                <p class="profile-text m-t-15 font-16"><a href="nguoidung"> {{Auth::user()->name}}</a></p>
            </div>
            @endif
        </div>
        @if(Auth::check())
        <nav class="sidebar-nav">
            <ul id="side-menu">
                @if(Auth::user()->quyen_dashboard)
                <li>
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> Dashboard <!-- <span class="label label-rounded label-info pull-right">3</span> --></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a href="dashboard2/hr">HR</a> </li>
                        <li> <a href="javascript:void(0);">Dashboard 2</a> </li>
                    </ul>
                </li>
                @endif
                <li>
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-basket fa-fw"></i> <span class="hide-menu"> Help </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a href="baoloi-danhsach">Báo lỗi</a> </li>
                        <li> <a href="phonebook">Danh bạ</a> </li>

                    </ul>
                </li>
                <!-- <li>
                    <a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-envelope-letter fa-fw"></i> <span class="hide-menu"> Inbox <span class="label label-rounded label-primary pull-right">5</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a href="inbox.html">Mail Box</a> </li>
                        <li> <a href="inbox-detail.html">Mail Details</a> </li>
                        <li> <a href="compose.html">Compose Mail</a> </li>
                        <li> <a href="contact.html">Contact</a> </li>
                        <li> <a href="contact-detail.html">Contact Detail</a> </li>
                    </ul>
                </li> -->
                @if(Auth::user()->quyen_activity)
                <li>
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-equalizer fa-fw"></i> <span class="hide-menu"> Hoạt động <!-- <span class="label label-rounded label-danger pull-right">1</span> --></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="activity">Danh sách</a></li>
                        
                    </ul>
                </li>
                @endif
                @if(Auth::user()->quyen_delivery)
                <li>
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-notebook fa-fw"></i> <span class="hide-menu"> Giao hàng <span class="label label-rounded label-info pull-right">NEW</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <!-- <li><a href="delivery2/logistic">Kế hoạch</a></li>
                        <li><a href="delivery2/baove">Bảo vệ</a></li>
                        <li><a href="delivery2/giaohang">Sản xuất</a></li> -->
                        <li><a href="delivery2/report">Thống kê</a></li>
                        <li><a href="delivery2/report/export">Xuất Excel</a></li>
                        

                    </ul>
                </li>
                @endif
                @if(Auth::user()->quyen_kpi)
                <li>
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-grid fa-fw"></i> <span class="hide-menu"> KPI<span class="label label-rounded label-danger pull-right"></span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="javascript:void(0);">All Function</a></li>
                        <li><a href="kpi/qc">QC</a></li>
                        <li><a href="kpi/maintenance">Maintenance</a></li>
                        <li><a href="kpi/outsource">Outsource</a></li>
                        <li><a href="kpi/production">Production</a></li>
                        <li><a href="kpi/safety">Safety</a></li>
                    </ul>
                </li>
                @endif 
                @if(Auth::user()->quyen_5s)
                <li>
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-pie-chart fa-fw"></i> <span class="hide-menu"> 5S</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="javascript:void(0);">Thống kê</a></li>
                        <li><a href="javascript:void(0);">Đánh giá</a></li>
                        <li><a href="javascript:void(0);">Danh sách</a></li>
                        <li><a href="javascript:void(0);">Raise Khiếm khuyết</a></li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->quyen_baotri)
                <li>
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-settings fa-fw"></i> <span class="hide-menu"> Maintenance<span class="label label-rounded label-success pull-right"></span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a href="javascript:void(0);">Các chỉ số</a>
                        </li>
                        <li><a href="javascript:void(0);">Quản lí chi phí</a></li>
                        
                    </ul>
                </li>
                @endif
                @if(Auth::user()->quyen_music)
                <li>
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> Music<span class="label label-rounded label-success pull-right"></span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a href="music">List</a>
                        </li>
                        <li><a href="music/activity">Schedule</a></li>
                        
                    </ul>
                </li>
                @endif
                @if(Auth::user()->quyen_ros)
                <li>
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> ROS<span class="label label-rounded label-success pull-right"></span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        @if(Auth::user()->quyen_ros >= 2)
                        <li> <a href="procurement/transport">Giá vận chuyển</a></li>
                        <li> <a href="procurement/product">Sản phẩm</a></li>
                        <li> <a href="procurement/estimatedprice">Estimated Price</a></li>
                        <li> <a href="procurement/review/ad">Review Proc</a></li>
                        @endif
                        <li> <a href="procurement/activity/firstcheck">Check giá</a></li>
                        @if(Auth::user()->quyen_ros >= 1)
                        <li> <a href="procurement/review">Review</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                <!-- <li>
                    <a href="calendar.html" aria-expanded="false"><i class="icon-calender fa-fw"></i> <span class="hide-menu"> Calendar</span></a>
                </li> -->
            </ul>
        </nav>
        @endif
        <div class="p-30">
            <span class="hide-menu">
                
                <a href="trangchu" target="_blank" class="btn btn-default m-t-15">Ver 1</a>
            </span>
        </div>
    </div>
</aside>