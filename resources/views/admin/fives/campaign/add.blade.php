@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">5S
                        <small>Thêm đợt đánh giá</small>
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

                    <form action="admin/fives/campaign/add" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tên đợt đánh giá</label>
                                <input type="text" name="name" placeholder="Tên đợt đánh giá" id="" class="form-control" />

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Note</label>
                                <input type="text" name="note" placeholder="Ghi chú" id="" class="form-control" />
                            </div>
                        </div>

                    
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-default">Thêm</button>
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