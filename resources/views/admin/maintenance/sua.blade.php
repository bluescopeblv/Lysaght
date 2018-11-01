@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance
                        <small>{{$machine->machine}}</small>
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

                    <form action="admin/maintenance/sua/{{$machine->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <label>Tên máy</label>
                            <input class="form-control" name="machine" placeholder="Nhập tên máy" value="{{$machine->machine}}" />
                        </div>
                        
                        <div class="form-group">
                            <label>Code</label>
                            <input class="form-control" name="code" placeholder="Nhập tên code của máy" value="{{$machine->code}}" />

                        </div>

                        <div class="form-group">
                            <label>Đã báo cáo</label>
                            <label class="radio-inline">
                                <input name="reportM3" value="0"  type="radio"
                                @if($machine->reportM3 != 1) 
                                    checked="" 
                                @endif

                                >Chưa
                            </label>
                            <label class="radio-inline">
                                <input name="reportM3" value="1" type="radio"
                                @if($machine->reportM3 == 1) 
                                    checked="" 
                                @endif
                                >Đã báo cáo
                            </label>
                            
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <input class="form-control" name="note" type="text" placeholder="Nhập note nếu có" value="{{$machine->note}}">
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