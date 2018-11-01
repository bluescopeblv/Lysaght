@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Activity
                        <small>Thêm</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">
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

                    <form action="admin/activity/add" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tên hoạt động</label>
                                <input class="form-control" name="name" placeholder="Nhập tên hoạt động"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ngày bắt đầu</label>
                                <input class="form-control" name="ngaybatdau" value="{{date('Y-m-d H:i:s')}}"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Deadline</label>
                                <input class="form-control" name="deadline" value="{{date('Y-m-d H:i:s')}}"/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <input class="form-control" name="noidung" placeholder="Nội dung"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Giải thưởng</label>
                                <input class="form-control" name="giaithuong" placeholder="Giải thưởng"/>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File đính kèm</label>
                                <input type="file" name="tenfile">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-default">Thêm</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
<!-- /#page-wrapper -->

@endsection