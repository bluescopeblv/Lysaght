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
                            <td>{{date('d-M-Y',strtotime($cs->updated_at))}} </td>
                            
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/maintenance/sua_chiso/{{$cs->id}}"> Sửa</a></td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance
                        <small>Danh sách các máy</small>
                        <small><span><a href="admin/maintenance/resetall">Reset all</a></span></small>
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
                            <th>STT</th>
                            <th>Code</th>
                            <th>Tên máy</th>
                            <th>Báo cáo bảo trì</th>
                            <th>Ghi chú</th>
                            
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cacmay as $cm)

                        <tr class="odd gradeX" align="center">
                            <td>{{$cm->id}}</td>
                            <td>{{$cm->code}}</td>  
                            <td>{{$cm->machine}}</td>                     
                            <td>
                                @if($cm->reportM3 == 1)
                                    <div class="dabaocao">
                                    <span class="glyphicon glyphicon-ok" style="font-size: 18;padding-right: 5px"> </span>Đã báo cáo
                                    </div>
                                @else
                                    <div class="chuabaocao">
                                    <span class="glyphicon glyphicon-remove" style="font-size: 18;padding-right: 5px"> </span>Chưa báo cáo
                                    </div>
                                @endif</td>
                            <td>{{$cm->note}}</td>
                            
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/maintenance/sua/{{$cm->id}}"> Sửa</a></td>
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