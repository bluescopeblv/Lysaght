@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">5S Question
                        <small>Sửa: {{ $question->question_group->name }}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">
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

                    <form action="admin/fives/question/edit/{{$question->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>STT</label>
                                <select class="form-control" name="stt">
                                    <option value="{{$question->stt}}">{{$question->stt}}</option>
                                    @for($i = 1;$i <= 40; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Group</label>
                                <select class="form-control" name="group_id">
                                    @foreach($question_group as $key => $val)
                                        @if($question->group_id == $val->id)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endif
                                    @endforeach
                                    @foreach($question_group as $key => $val)
                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nội dung câu hỏi</label>
                                
                                <textarea rows="4" cols="50" name="noidung" placeholder="Nhập tên hoạt động" id="noidung" class="form-control">{{$question->noidung}}</textarea>

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Chỉ tiêu</label>
                                <textarea rows="4" cols="50" name="chitieu" placeholder="Nhập chỉ tiêu đánh giá" id="chitieu" class="form form-control">{{$question->chitieu}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-default">Sửa</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
<!-- /#page-wrapper -->

@endsection