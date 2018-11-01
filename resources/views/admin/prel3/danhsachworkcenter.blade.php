@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">PRE-L3
                        <small>Danh sách Workcenter</small>
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
                            <th>Workcenter</th>                            
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workcenter as $wc)
                        <tr class="odd gradeX" align="center">
                            <td>{{$wc->id}}</td>
                            <td>{{$wc->name}}</td>
                                                                                   
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/prel3/suawc/{{$wc->id}}"> Sửa</a></td>
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