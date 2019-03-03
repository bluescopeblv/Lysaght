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
                <span class="tieude">PROCUREMENT - PRICE CHECK</span>
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
            <form action="procurement/activity/firstcheck" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-body">
                    <div class="panel-group">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            
                            <div class="col-md-12">
                                <div class="form-group has-danger" style="background-color: rgba(255, 0, 0, 0.7);padding: 10px 20px 10px 20px; border-radius: 15px;color: white; ">
                                    <span style="font-size: 20px;" >Hiện tại công ty NS Bluescope Lysaght không cung cấp được dịch vụ cán tôn ở điều kiện cầu đường dưới tải trọng 42 tấn.


                                    </span>
                                    <br><br>

                                    <p>Để biết thêm thông tin chi tiết vui lòng liên hệ http://www.bluescope.com.vn</p> 
                                </div>
                                </div>
                        </div>

                    </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')


@endsection