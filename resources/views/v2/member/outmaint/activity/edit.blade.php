@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
.white-box{
    font-family: "Arial";
    color: blue;
}

.tieude{
    font-family: "Arial";
    color: blue;
    font-size: 20px;
    font-style: bold;
}
.white-box{
    color: black;
}
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-body">
                <span class="tieude">OUTSOURCE MAINTENANCE - CHỈNH SỬA</span>
                <span style="float:right; display: block">
                <a href="outmaint/activity">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Quay về danh sách </button></a></span>
            </div>
        </div>
    </div>
</div>

<!-- /row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
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
                <form action="outmaint/activity/edit/{{ $activity->id }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <div class="panel-group">
                        <div class="panel panel-info">
                            <div class="panel-heading">MAINTENANCE RECORD | Thêm mới</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Machine *</label>
                                            <select class="form-control" name="outs_maint_machine_id">
                                                @foreach($machines as $key => $val)
                                                    <option value="{{$val->id}}"
                                                        @if($val->id  == $activity->outs_maint_machine_id )
                                                            selected=""
                                                        @endif
                                                        >{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Type *</label>
                                            <select class="form-control" name="outs_maint_type_id">
                                                @foreach($types as $key => $val)
                                                    <option value="{{$val->id}}"
                                                        @if($val->id  == $activity->outs_maint_type_id )
                                                            selected=""
                                                        @endif
                                                        >{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group has-danger">
                                            <label class="control-label">Ngày</label>
                                            <input type="datetime" name="date" class="form-control form-control-danger" placeholder="yyyy-mm-dd" value="{{ $activity->date }}">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-10">
                                        <div class="form-group has-danger">
                                            <label class="control-label">Nội dung bảo trì</label>
                                            <input type="text" name="content" class="form-control form-control-danger" placeholder="Nhập nội dung bảo trì" value="{{ $activity->content }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group has-danger">
                                            <label class="control-label">Ngày hoành thành</label>
                                            <input type="datetime" name="solution_date" class="form-control form-control-danger" placeholder="yyyy-mm-dd" value="{{ $activity->solution_date }}">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-10">
                                        <div class="form-group has-danger">
                                            <label class="control-label">Solution (Nếu có)</label>
                                            <input type="text" name="solution" class="form-control form-control-danger" placeholder="Đã khắc phục, sửa chữa như thế nào" value="{{ $activity->solution }}">
                                        </div>
                                    </div>
                                    <!--/row-->
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">THÔNG TIN THÊM (Nếu có)</div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Note</label>
                                        <input type="text" name="note" class="form-control form-control-danger" placeholder="Note" value="{{ $activity->note }}">
                                    </div>
                                </div>
                                
                                <!-- <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Đính kèm file</label>
                                        <input type="file" name="attach">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        
                      </div>

                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Edit</button>
                    </div>
                </form>
        </div>
    </div>
</div>



@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": true,
                "targets": 2
            }],
            "order": [
                [2, 'asc']
            ],
            "displayLength": 25,
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
        // Order by the grouping
        $('#example tbody').on('click', 'tr.group', function() {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            } else {
                table.order([2, 'asc']).draw();
            }
        });
    });
});



</script>
@endsection