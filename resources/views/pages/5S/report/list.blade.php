@extends('layout.index')

@section('content')
<div class="container">
    <div class="panel panel-primary ">
        <div class="panel-heading">5S | REPORT </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-2">
                    <small>ĐỢT ĐÁNH GIÁ</small>
                </div>
                <div class="col-lg-10" style="color: orange">
                    <h1 class="page-header">REPORT
                        
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">

                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}           
                    </div>
                @endif
                
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>#</th>
                            <th>Đợt đánh giá</th>
                            <th>Đánh giá nhóm</th>
                            <th>Tiêu chẩn đánh giá</th>
                            <th>Khu vực</th>
                            <th>Trưởng nhóm đánh giá</th>
                            <th>Ngày đánh giá</th>
                            <th>Tỉ lệ đạt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($campaign as $key1 => $val1)
                        @foreach($chamdiem as $key2 => $val2)
                            @if($val1->id == $val2->campaign_id)
                            <tr class="odd gradeX" align="center">
                                <td>{{$val2->id}}</td>
                                <td>{{$val1->name}}</td>
                                <td>{{$val2->nhanvien_group->name}}</td>
                                <td>{{$val2->question_group->name}}</td>
                                <td>{{$val2->khuvucdanhgia}}</td>
                                <td>{{$val2->truongnhomdanhgia}}</td>
                                <td>{{date('d-M-Y',strtotime($val2->ngaydanhgia))}}</td>

                                
                                                                                       
                                <td class="center">{{getDiem_5S_Nhom($val2->id)}} %</td>
                            </tr>
                            @endif
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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