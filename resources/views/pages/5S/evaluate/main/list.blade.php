@extends('layout.index')

@section('content')
<div class="container">
    <div class="panel panel-primary ">
        <div class="panel-heading">5S | Danh sách </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-2">
                    <small>ĐỢT ĐÁNH GIÁ</small>
                </div>
                <div class="col-lg-10" style="color: orange">
                    <h1 class="page-header">{{ $campaign->name }}
                        
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">

                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}           
                    </div>
                @endif
                
                <div style="text-align: right; margin-bottom: 5px">
                    <a href="fives/evaluate/campaign/add"><div class="btn btn-success">Thêm mới</div></a>
                </div>

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>#</th>
                            <th>Đánh giá nhóm</th>
                            <th>Tiêu chẩn đánh giá</th>
                            <th>Khu vực</th>
                            <th>Trưởng nhóm đánh giá</th>
                            <th>Ngày đánh giá</th>

                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($chamdiem as $key => $val)
                        <tr class="odd gradeX" align="center">
                            <td>{{$val->id}}</td>
                            <td>{{$val->nhanvien_group->name}}</td>
                            <td><a href="">{{$val->question_group->name}}</a></td>
                            <td>{{$val->khuvucdanhgia}}</td>
                            <td>{{$val->truongnhomdanhgia}}</td>
                            <td>{{date('d-M-Y',strtotime($val->ngaydanhgia))}}</td>

                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="fives/evaluate/main/delete/{{$val->id}}">Xóa</a></td>
                                                                                   
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="fives/evaluate/main/edit/{{$val->id}}">Sửa</a></td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div id="page-wrapper">
        <div class="container-fluid">
            
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
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