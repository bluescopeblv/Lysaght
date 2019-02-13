@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
.white-box{
    font-family: "Arial";
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
                <span class="tieude">UPDATE KPI - OUTSOURCE - EDIT</span>
                <span style="float:right; display: block">
                <a href="kpi/outsource">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="glyphicon glyphicon-circle-arrow-left"></i> Quay về danh sách </button>
                </a></span>
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
                <form action="kpi/outsource/edit/{{$KPI->id}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <h4>THỜI GIAN:  <span style="color: blue">{{$KPI->name}}</span></h4>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Inbound truck booking</label>
                                    <input type="text" name="OUT_INBOUND_TRUCK" class="form-control" placeholder="Inbound truck booking" value="{{ $KPI->OUT_INBOUND_TRUCK }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group has-danger">
                                    <label class="control-label">Outsource & Buy out Logistic cost</label>
                                    <input type="text" name="OUT_LOGICTIS_COST" class="form-control form-control-danger" placeholder="Outsource & Buy out Logistic cost" value="{{ ($KPI->OUT_LOGICTIS_COST) }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Outsource volume (Tons)</label>
                                    <input type="text" name="OUT_VOLUME" class="form-control form-control-danger" placeholder="Outsource volume (Tons)" value="{{ $KPI->OUT_VOLUME }}">
                                </div>
                            </div>
                            <!--/span-->
                            
                        </div>
                        <!--/row-->
                        <div class="row p-t-20">
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Outsource Cost</label>
                                    <input type="text" name="OUT_COST" class="form-control form-control-danger" placeholder="Outsource Cost" value="{{ $KPI->OUT_COST }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">ROS (m2)</label>
                                    <input type="text" name="OUT_ROS" class="form-control form-control-danger" placeholder="ROS (m2)" value="{{ $KPI->OUT_ROS }}">
                                </div>    
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">ROS cost (Vnd)</label>
                                    <input type="text" name="OUT_ROS_COST" class="form-control form-control-danger" placeholder="ROS cost (Vnd)" value="{{ $KPI->OUT_ROS_COST }}">
                                </div>    
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
                    </div>
                </form>
                <hr>
                
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