@extends('layout.index')

@section('content')

<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">5S
                        <small>Danh sách Group Nhân viên</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">
                    
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}           
                    </div>
                @endif
                
                <h4><span class="label label-success"><a href="fives/evaluate/nhanvien-group/add">Thêm mới</a></span></h4>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Tên group</th>                            
                            <th>Note</th>

                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nhanvien_group as $key => $val)
                        <tr class="odd gradeX" align="center">
                            <td>{{$val->id}}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->note}}</td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="fives/evaluate/nhanvien-group/delete/{{$val->id}}"> Xóa</a></td>
                            
                                                                                   
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="fives/evaluate/nhanvien-group/edit/{{$val->id}}"> Sửa</a></td>
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

@section('script')

<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });

    $('#dataTables-example1').DataTable({
        responsive: true
    });
});
</script>
@endsection