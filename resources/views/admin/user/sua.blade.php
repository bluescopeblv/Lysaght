@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>{{$user->name}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">

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

                    <form action="admin/user/sua/{{$user->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Họ và tên</label>
                            <input class="form-control" name="name" placeholder="Nhập họ tên người dùng" value="{{$user->name}}" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ Email" value="{{$user->email}}" readonly="" />
                        </div>
                        <div class="form-group">
                            <label>SĐT</label>
                            <input type="input" class="form-control" name="sdt" placeholder="Nhập số điện thoại" value="{{$user->sdt}}"/>
                        </div>
                        <div class="form-group">
                            <label>SĐT 2</label>
                            <input type="input" class="form-control" name="sdt2" placeholder="Nhập số điện thoại" value="{{$user->sdt2}}"/>
                        </div>
                        <div class="form-group">
                            <label>Workcenter</label>
                            <input type="Workcenter" class="form-control" name="workcenter" placeholder="Nhập workcenter" value="{{$user->workcenter}}"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="changePassword" name="changePassword">
                            <label>Đổi mật khẩu</label>
                            
                            <input type="password" class="form-control password" name="password" placeholder="Nhập mật khẩu" disabled=""/>
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control password" name="passwordAgain" placeholder="Nhập lại mật khẩu" disabled=""/>
                        </div>
                        
                        <div class="form-group">
                            <label>Quyền người dùng</label>
                            <label class="radio-inline">
                                <input name="quyen" value="0"  
                                @if($user->quyen == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Không có quyền
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="1" 
                                @if($user->quyen == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="2" 
                                @if($user->quyen == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Sup/Manager
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="3" 
                                @if($user->quyen == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Admin
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Quyền Pre L3</label>
                            <label class="radio-inline">
                                <input name="quyen_preL3" value="0"  
                                @if($user->quyen_preL3 == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Không có quyền
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_preL3" value="1" 
                                @if($user->quyen_preL3 == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_preL3" value="2" 
                                @if($user->quyen_preL3 == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Sup/Manager
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_preL3" value="3" 
                                @if($user->quyen_preL3 == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Admin
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Quyền 5S</label>
                            <label class="radio-inline">
                                <input name="quyen_5s" value="0"  
                                @if($user->quyen_5s == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Không có quyền
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_5s" value="1" 
                                @if($user->quyen_5s == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_5s" value="2" 
                                @if($user->quyen_5s == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Sup/Manager
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_5s" value="3" 
                                @if($user->quyen_5s == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Admin
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Quyền bảo trì</label>
                            <label class="radio-inline">
                                <input name="quyen_baotri" value="0"  
                                @if($user->quyen_baotri == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Không có quyền
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_baotri" value="1" 
                                @if($user->quyen_baotri == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_baotri" value="2" 
                                @if($user->quyen_baotri == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Sup/Manager
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_baotri" value="3" 
                                @if($user->quyen_baotri == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Admin
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Quyền báo lỗi</label>
                            <label class="radio-inline">
                                <input name="quyen_baoloi" value="0"  
                                @if($user->quyen_baoloi == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Không có quyền
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_baoloi" value="1" 
                                @if($user->quyen_baoloi == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_baoloi" value="2" 
                                @if($user->quyen_baoloi == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Sup/Manager
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_baoloi" value="3" 
                                @if($user->quyen_baoloi == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Admin
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Quyền Activity</label>
                            <label class="radio-inline">
                                <input name="quyen_activity" value="0"  
                                @if($user->quyen_activity == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Không có quyền
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_activity" value="1" 
                                @if($user->quyen_activity == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_activity" value="2" 
                                @if($user->quyen_activity == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Sup/Manager
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_activity" value="3" 
                                @if($user->quyen_activity == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Admin
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Quyền delivery</label>
                            <label class="radio-inline">
                                <input name="quyen_delivery" value="0"  
                                @if($user->quyen_delivery == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Không có quyền
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_delivery" value="1" 
                                @if($user->quyen_delivery == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_delivery" value="2" 
                                @if($user->quyen_delivery == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Sup/Manager
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_delivery" value="3" 
                                @if($user->quyen_delivery == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Admin
                            </label>
                        </div>
                        <!-- Quyen ROS -->
                        <div class="form-group">
                            <label>Quyền ROS</label>
                            <label class="radio-inline">
                                <input name="quyen_ros" value="0"  
                                @if($user->quyen_ros == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Không có quyền
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_ros" value="1" 
                                @if($user->quyen_ros == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_ros" value="2" 
                                @if($user->quyen_ros == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Sup/Manager
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_ros" value="3" 
                                @if($user->quyen_ros == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Admin
                            </label>
                        </div>

                        <!-- Quyen KPI -->
                        <div class="form-group">
                            <label>Quyền KPI</label>
                            <label class="radio-inline">
                                <input name="quyen_kpi" value="0"  
                                @if($user->quyen_kpi == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Không có quyền
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_kpi" value="1" 
                                @if($user->quyen_kpi == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_kpi" value="2" 
                                @if($user->quyen_kpi == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Sup/Manager
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_kpi" value="3" 
                                @if($user->quyen_kpi == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Admin
                            </label>
                        </div>

                        <!-- Quyen Dashboard -->
                        <div class="form-group">
                            <label>Quyền Dashboard</label>
                            <label class="radio-inline">
                                <input name="quyen_dashboard" value="0"  
                                @if($user->quyen_dashboard == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Không có quyền
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_dashboard" value="1" 
                                @if($user->quyen_dashboard == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_dashboard" value="2" 
                                @if($user->quyen_dashboard == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Sup/Manager
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_dashboard" value="3" 
                                @if($user->quyen_dashboard == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Admin
                            </label>
                        </div>

                        <!-- Quyen Music -->
                        <div class="form-group">
                            <label>Quyền Music</label>
                            <label class="radio-inline">
                                <input name="quyen_music" value="0"  
                                @if($user->quyen_music == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Không có quyền
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_music" value="1" 
                                @if($user->quyen_music == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Thường
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_music" value="2" 
                                @if($user->quyen_music == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Sup/Manager
                            </label>
                            <label class="radio-inline">
                                <input name="quyen_music" value="3" 
                                @if($user->quyen_music == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Admin
                            </label>
                        </div>

                        <!-- Quyen Version -->
                        <div class="form-group">
                            <label>Quyền Version</label>
                            <label class="radio-inline">
                                <input name="ver" value="0"  
                                @if($user->ver == 0)
                                    {{'checked=""'}}
                                @endif
                                type="radio">Ver 1
                            </label>
                            <label class="radio-inline">
                                <input name="ver" value="1" 
                                @if($user->ver == 1)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Ver 1
                            </label>
                            <label class="radio-inline">
                                <input name="ver" value="2" 
                                @if($user->ver == 2)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Ver 2
                            </label>
                            <label class="radio-inline">
                                <input name="ver" value="3" 
                                @if($user->ver == 3)
                                    {{'checked=""'}}
                                @endif
                                 type="radio">Ver 3
                            </label>
                        </div>

                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
<!-- /#page-wrapper -->

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $("#changePassword").change(function(){
                if($(this).is(":checked"))
                {
                    $(".password").removeAttr('disabled');
                }
                else
                {
                    $(".password").attr('disabled','');
                }
            });
        });
    </script>
    
@endsection