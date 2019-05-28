@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">OUTSOURCE - MAINTENANCE TYPE
                        <small>{{$type->name}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($error->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}                         
                        </div>
                    @endif

                    <form action="admin/outmaint/type/edit/{{ $type->id }}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <label>Tên Type</label>
                            <input class="form-control" name="name" placeholder="Nhập tên type" value="{{$type->name}}" />
                        </div>

                        <div class="form-group">
                            <label>Note</label>
                            <input class="form-control" name="note" placeholder="Note" value="{{$type->note}}"/>
                        </div>
                        
                        <div class="form-group">
                            <label>Active</label>
                            <select class="form-control" name="active"  id="active">
                                @if($type->active == 1)
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                @else
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                @endif
                            </select>
                        </div>
                    
                        <button type="submit" class="btn btn-default">Edit</button>
                    </form>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
<!-- /#page-wrapper -->

@endsection