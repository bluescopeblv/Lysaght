@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Activity
                        <small>Sửa {{$activity->id}} : {{ $activity->name}}</small>
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

                    <form action="admin/activity/edit/{{$activity->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tên hoạt động</label>
                                <input class="form-control" name="name" placeholder="Nhập tên hoạt động" value="{{$activity->name}}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ngày bắt đầu</label>
                                <input class="form-control" name="ngaybatdau" value="{{$activity->ngaybatdau}}"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Deadline</label>
                                <input class="form-control" name="deadline" value="{{$activity->deadline}}"/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <input class="form-control" name="noidung" placeholder="Nội dung" value="{{$activity->noidung}}"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Giải thưởng</label>
                                <input class="form-control" name="giaithuong" placeholder="Giải thưởng" value="{{$activity->giaithuong}}"/>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File đính kèm: 
                                    @if($activity->tenfile)
                                        <a href="upload/activity/files/{{$activity->tenfile}}">Đã có file: {{substr($activity->tenfile,0,strlen($activity->tenfile)-19).substr($activity->tenfile,strlen($activity->tenfile)-4,4)}}</a>
                                    @else
                                        
                                    @endif
                                    <!-- //strlen($chiphi->tenchungtu) - 12 -->
                                </label>
                                <input type="file" name="tenfile">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-default">Sửa</button>
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