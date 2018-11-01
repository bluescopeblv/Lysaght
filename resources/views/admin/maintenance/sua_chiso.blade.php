@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance
                        <small>Sửa - Chỉ số</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($error->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}                         
                        </div>
                    @endif

                    <form action="admin/maintenance/sua_chiso/1" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <label>Số vụ hư hỏng</label>
                            <input class="form-control" name="sovuhuhong" placeholder="Số vụ hư hỏng" value="{{$chiso->sovuhuhong}}" />
                        </div>
                        
                        <div class="form-group">
                            <label>Thời gian / Trường hợp</label>
                            <input class="form-control" name="thoigianpervu" value="{{$chiso->thoigianpervu}}" />

                        </div>

                        <div class="form-group">
                            <label>Preventive </label>
                            <input class="form-control" name="preventive" type="text" placeholder="% bảo dưỡng định kì" value="{{$chiso->preventive}}">
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