@extends('layout.index')

@section('content')
<div class="container">
    <div class="panel panel-primary ">
        <div class="panel-heading">5S | Danh sách Đợt đánh giá </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">5S
                        <small></small>
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
                            <th>ID</th>
                            <th>Đợt đánh giá</th>
                            <th>Note</th>
                            <th>Đã đánh giá</th>
                            <th>Action</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($campaign as $key => $val)
                        <tr class="odd gradeX" align="center">
                            <td>{{$val->id}}</td>

                            <td>{{$val->name}}</td>
                            <td>{{$val->note}}</td>

                            <td><a href="fives/evaluate/main/{{$val->id}}">{{get5Sdanhgia($val->id)}}</a></td>

                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="fives/evaluate/main/add/{{$val->id}}">Chấm điểm >></a></td>

                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="fives/evaluate/campaign/delete/{{$val->id}}">Xóa</a></td>
                                                                                   
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="fives/evaluate/campaign/edit/{{$val->id}}">Sửa</a></td>
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