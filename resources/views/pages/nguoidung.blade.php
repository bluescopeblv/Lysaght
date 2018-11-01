@extends('layout.index')

@section('content')

<!-- Page Content -->
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Thông tin tài khoản</div>
                    <div class="panel-body">
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
                        <form action="nguoidung" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div>
                                <label>Họ tên</label>
                                <input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1" value="{{$nguoidung->name}}">
                            </div>
                            <br>
                            <div>
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1" value="{{$nguoidung->email}}" 
                                disabled
                                >
                            </div>
                            <br>
                            <div>
                                <label>SĐT 1</label>
                                <input type="input" class="form-control" placeholder="Số điện thoại" name="sdt" aria-describedby="basic-addon1" value="{{$nguoidung->sdt}}">
                            </div>
                            <br>
                            <div>
                                <label>SĐT 2</label>
                                <input type="input" class="form-control" placeholder="Số điện thoại" name="sdt2" aria-describedby="basic-addon1" value="{{$nguoidung->sdt2}}">
                            </div>
                            <br>
                            <div>
                                <label>Workcenter</label>
                                <select class="form-control" name="workcenter" value="{{$nguoidung->workcenter}}">
                                    <option>{{$nguoidung->workcenter}}</option>
                                    
                                    @foreach($workcenter as $wc)
                                        @if($wc->name != $nguoidung->workcenter)
                                        <option style="color:blue" value="{{ $wc->name }}">{{ $wc->name }}</option>
                                        @endif
                                    @endforeach
                                    <option></option>
                                </select>

                            </div>
                            <br>    
                            <div>
                                <input type="checkbox" class="" name="changePassword" id="changePassword">
                                <label>Đổi mật khẩu</label>
                                <input type="password" class="form-control password" name="password" aria-describedby="basic-addon1" disabled="" placeholder="password">
                            </div>
                            <br>
                            <div>
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control password" name="passwordAgain" aria-describedby="basic-addon1" disabled="" placeholder="password">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-default">Sửa
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->


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