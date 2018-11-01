@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance
                        <small>Chỉ số</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->

                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}           
                    </div>
                @endif
                
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Số vụ hư hỏng</th>
                            <th>Thời gian/vụ</th>
                            <th>Tỉ lệ bảo dưỡng định kì</th>
                            <th>Thời gian cập nhật</th>
                            
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($chiso as $cs)

                        <tr class="odd gradeX" align="center">
                            <td>{{$cs->id}}</td>
                            <td style="color:@if($cs->sovuhuhong < 80) green
                                            @else red @endif"> {{$cs->sovuhuhong}} trường hợp</td>
                            <td style="color:@if($cs->thoigianpervu < 2.5) green
                                            @else red @endif"> {{$cs->thoigianpervu}} giờ/trường hợp</td>
                            <td style="color:@if($cs->preventive > 97) green
                                            @else red @endif"> {{$cs->preventive}} %</td>
                            <td>{{date('d-M-Y',strtotime($cs->created_at))}} </td>
                            
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{$cs->id}}"> Sửa</a></td>
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