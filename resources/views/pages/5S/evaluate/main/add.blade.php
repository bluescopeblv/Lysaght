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
                        <form action="fives/evaluate/main/add/{{$campaign->id}}" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Đợt đánh giá</label>
                                    <select class="form-control" type="text" name="donvitinh" readonly="">
                                        <option value="{{$campaign->id}}">{{$campaign->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Khu vực đánh giá</label>
                                    <input class="form-control" type="text" name="khuvucdanhgia" placeholder="Khu vực đánh giá" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Trưởng nhóm đánh giá</label>
                                    <input class="form-control" type="text" name="truongnhomdanhgia" placeholder="Trưởng nhóm đánh giá" value="{{Auth::user()->name}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Ngày đánh giá</label>
                                    <input class="form-control" type="text" name="ngaydanhgia" placeholder="Số hóa đơn" value="{{date('Y-m-d')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Đánh giá nhóm</label>
                                    <select class="form-control" type="text" name="nhanvien_group_id">
                                        <option value="Cái">..... Chọn nhóm .....</option>
                                        @foreach($nhanvien_group as $key => $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Chọn câu hỏi đánh giá</label>
                                    <select class="form-control" type="text" name="question_group_id" id="question_group_id">
                                        <option value="Cái">..... Chọn câu hỏi .....</option>
                                        @foreach($question_group as $key => $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
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
                            
                            
                            <div id="cauhoi"></div>
                        </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                        
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
    $(document).ready(function() {
        $("#question_group_id").change(function(){
            var question_group_id = $(this).val();

            $.get("fives/evaluate/main/question/"+question_group_id,function(data) {
                //alert(data);
                $("#cauhoi").html(data);
            });
        });

        
    });
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