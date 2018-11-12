@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">5S
                        <small>Thêm nhân viên</small>
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

                    <form action="admin/fives/nhanvien/add" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Group</label>
                                <select class="form-control" name="group_id">
                                    @foreach($nhanvien_group as $key => $val)
                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tên nhân viên</label>
                                <input type="text" name="name" placeholder="Tên nhân viên" id="" class="form-control" />

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone" placeholder="Số điện thoại" id="" class="form-control" />
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