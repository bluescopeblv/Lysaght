@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>danh sách</small>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>SĐT 2</th>
                            <th>Workcenter</th>
                            <th>Level</th>
                            <th>Quyền PreL3</th>
                            <th>Quyền 5S</th>
                            <th>Quyền Báo lỗi</th>
                            <th>Quyền Bảo trì</th>
                            <th>Activity</th>
                            <th>Delivery</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $u)
                        <tr class="odd gradeX" align="center">
                            <td>{{$u->id}}</td>
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->sdt}}</td>
                            <td>{{$u->sdt2}}</td>
                            <td>{{$u->workcenter}}</td>
                            <td>
                                @if($u->quyen == 3)
                                    Admin
                                @elseif($u->quyen == 2)
                                    Sup/Manager
                                @elseif($u->quyen == 1)
                                    Thường
                                @else
                                    Không có quyền
                                @endif
                            </td>
                            <td>
                                @if($u->quyen_preL3 == 3)
                                    Admin
                                @elseif($u->quyen_preL3 == 2)
                                    Sup/Manager
                                @elseif($u->quyen_preL3 == 1)
                                    Thường
                                @else
                                    Không có quyền
                                @endif
                            </td>
                            <td>
                                @if($u->quyen_5s == 3)
                                    Admin
                                @elseif($u->quyen_5s == 2)
                                    Sup/Manager
                                @elseif($u->quyen_5s == 1)
                                    Thường
                                @else
                                    Không có quyền
                                @endif
                            </td>
                            <td>
                                @if($u->quyen_baoloi == 3)
                                    Admin
                                @elseif($u->quyen_baoloi == 2)
                                    Sup/Manager
                                @elseif($u->quyen_baoloi == 1)
                                    Thường
                                @else
                                    Không có quyền
                                @endif
                            </td>
                            <td>
                                @if($u->quyen_baotri == 3)
                                    Admin
                                @elseif($u->quyen_baotri == 2)
                                    Sup/Manager
                                @elseif($u->quyen_baotri == 1)
                                    Thường
                                @else
                                    Không có quyền
                                @endif
                            </td>
                            <td>
                                @if($u->quyen_activity == 3)
                                    Admin
                                @elseif($u->quyen_activity == 2)
                                    Sup/Manager
                                @elseif($u->quyen_activity == 1)
                                    Thường
                                @else
                                    Không có quyền
                                @endif
                            </td>
                            <td>
                                @if($u->quyen_delivery == 3)
                                    Admin
                                @elseif($u->quyen_delivery == 2)
                                    Sup/Manager
                                @elseif($u->quyen_delivery == 1)
                                    Thường
                                @else
                                    Không có quyền
                                @endif
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/xoa/{{$u->id}}"> Xóa</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/sua/{{$u->id}}"> Sửa</a></td>
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