@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">5S
                        <small>Danh sách nhân viên</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">

                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}           
                    </div>
                @endif
                
                <h4><a href="admin/fives/nhanvien/add">Thêm mới</a></h4>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Group</th>
                            <th>Họ và tên</th>
                            <th>Phone</th>                            
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nhanvien as $key => $val)
                        <tr class="odd gradeX" align="center">
                            <td>{{$val->id}}</td>
                            <td>{{$val->nhanvien_group->name }}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->phone}}</td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/fives/nhanvien/delete/{{$val->id}}">Xóa</a></td>
                                                                                   
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/fives/nhanvien/edit/{{$val->id}}">Sửa</a></td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection