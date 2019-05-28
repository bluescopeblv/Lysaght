@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">OUTSOURCE - MAINTENANCE TYPE
                        <small>Danh sách Type</small>
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
                            <th>Type</th>
                            <th>Active</th>
                            <th>Note</th>                            
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($types as $key => $val)
                        <tr class="odd gradeX" align="center">
                            <td>{{$val->id}}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->active}}</td>
                            <td>{{$val->note}}</td>                                                        
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/outmaint/type/edit/{{$val->id}}"> Sửa</a></td>
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