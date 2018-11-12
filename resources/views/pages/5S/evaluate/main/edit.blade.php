@extends('layout.index')
@section('content')
    <div class="container">
        <div class="row carousel-holder">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">5S CHẤM ĐIỂM | <a href="fives/evaluate/campaign">Danh sách đợt đánh giá</a> | THÊM</div>
                    <div class="panel-body">
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
                        
                        @if(Auth::user())
                        <!-- RECORD CHI PHÍ -->
                        <form action="fives/evaluate/main/edit/{{$chamdiem->id}}" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Đợt đánh giá</label>
                                    <select class="form-control" type="text" name="donvitinh" readonly="">
                                        <option value="{{$chamdiem->campaign->id}}">{{$chamdiem->campaign->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Khu vực đánh giá</label>
                                    <input class="form-control" type="text" name="khuvucdanhgia" placeholder="Khu vực đánh giá" value="{{ $chamdiem->khuvucdanhgia }}" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Trưởng nhóm đánh giá</label>
                                    <input class="form-control" type="text" name="truongnhomdanhgia" placeholder="Trưởng nhóm đánh giá" value="{{ $chamdiem->truongnhomdanhgia }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Ngày đánh giá</label>
                                    <input class="form-control" type="text" name="ngaydanhgia" placeholder="Số hóa đơn" value="{{date('Y-m-d', strtotime($chamdiem->ngaydanhgia))}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Đánh giá nhóm</label>
                                    <select class="form-control" type="text" name="nhanvien_group_id" readonly="">
                                        <option value="{{$chamdiem->nhanvien_group->id}}">{{$chamdiem->nhanvien_group->name}}</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Chọn câu hỏi đánh giá</label>
                                    <select class="form-control" type="text" name="question_group_id" id="question_group_id" readonly="">
                                        <option value="{{$chamdiem->question_group->id}}">{{$chamdiem->question_group->name}}</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>File đính kèm (Nếu có)</label>
                                    <input type="file" name="dinhkem">
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                        <div>
                            <table class="table color-table info-table">
                            <thead>
                                <tr align="center">
                                    <th>STT</th>
                                    <th>Nội dung</th>
                                    <th>Tóm tắt</th>
                                    <th class="diem">Điểm</th>
                                    <th class="nhanxet">Nhận xét</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chitiet as $val)
                                <tr>
                                    <td>{{ get5Scauhoi($val->cauhoi_id)->stt }}</td>
                                    <td>{{ get5Scauhoi($val->cauhoi_id)->noidung }}</td>
                                    <td>{{ get5Scauhoi($val->cauhoi_id)->chitieu }}</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="diem{{ get5Scauhoi($val->cauhoi_id)->stt }}" value="{{ $val->diem }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="nhanxet{{ get5Scauhoi($val->cauhoi_id)->stt }}" value="{{ $val->nhanxet }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach                  
                            </tbody>   
                        </table>

                        </div>
                        </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                        
                        </form>
                        <!-- END RECORD CHI PHÍ -->
                        @else
                            Đăng nhập để record lỗi
                        @endif



                    </div>
                </div>
            </div>
            <!-- Maintenance Record Them moi -->
        </div>
        <!-- end slide -->
    </div>

@endsection

@section('script')
<script>
    
</script>

<style type="text/css">
  table,th,td{
      border:1px solid green;
      border-collapse: collapse;
  }
  table{
      width: 95%;
  }
  th.nhanxet{
      width: 30%;
  }
  th.right{
      width: 50%;
  }
</style>

@endsection