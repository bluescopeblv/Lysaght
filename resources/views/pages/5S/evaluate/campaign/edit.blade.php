@extends('layout.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">5S | Sửa đợt đánh giá
                <small style="color: blue">{{ $campaign->name }}</small>
            </h1>
        </div>
        <div style="text-align: right;"><a href="fives/evaluate/campaign/">Quay lại</a></div>
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

            <form action="fives/evaluate/campaign/edit/{{$campaign->id}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tên đợt đánh giá</label>
                        <input type="text" name="name" placeholder="Tên đợt đánh giá" id="" class="form-control" value="{{ $campaign->name }}" />

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Note</label>
                        <input type="text" name="note" placeholder="Ghi chú" id="" class="form-control" value="{{ $campaign->note }}" />
                    </div>
                </div>

            
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Sửa</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('script')
  <script>
       
  </script>
@endsection