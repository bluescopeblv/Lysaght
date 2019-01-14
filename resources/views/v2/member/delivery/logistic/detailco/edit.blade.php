@extends('layout.index')

@section('css')
    
@endsection
@section('content')
<div class="container">
<!-- Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white"><a href="delivery/logistic/detailco/{{$thongtinxe->id}}">Danh sách CO</a></h4>
            </div>
            <div class="card-body">
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
                <form action="delivery/logistic/detailco/{{$thongtinxe->id}}/edit/{{$CO->id}}" method="post">
                	<input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <h3 class="card-title">Dự án: {{$thongtinxe->khachhang}}, CO: {{$CO->CO}} |<small> Sửa</small>  <span></span></h3>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">CO</label>
                                    <input type="text" name="CO" class="form-control" placeholder="Nhập tên CO" value="{{ $CO->CO }}">
                                     </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-8">
                                <div class="form-group has-danger">
                                    <label class="control-label">Chi tiết giao hàng</label>
                                    <input type="text" name="chitietgiaohang" class="form-control form-control-danger" placeholder="Nhập tên tài xế" value="{{ $CO->chitietgiaohang }}">
                                </div>
                            </div>
                            <!--/span-->
                            
                        </div>
                        <!--/row-->
                    </div>          
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Sửa</button>
                        <button type="button" class="btn btn-inverse">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Row -->
</div>

@endsection

@section('script')
  <script>
	   
  </script>
@endsection