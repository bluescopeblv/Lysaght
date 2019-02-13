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
                <span class="tieude">UPDATE KPI - PRODUCTION - EDIT</span>
                <span style="float:right; display: block">
                <a href="kpi/production">
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
                <form action="kpi/production/edit/{{$KPI->id}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <h4>THỜI GIAN:  <span style="color: blue">{{$KPI->name}}</span></h4>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Manufactured Volume (Ton)</label>
                                    <input type="text" name="MFG_VOLUME" class="form-control" placeholder="Manufactured Volume (Ton)" value="{{ $KPI->MFG_VOLUME }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">OEE (%)</label>
                                    <input type="text" name="MFG_OEE" class="form-control form-control-danger" placeholder="OEE (%)" value="{{ ($KPI->MFG_OEE) }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Uptime (%)</label>
                                    <input type="text" name="MFG_UPTIME" class="form-control form-control-danger" placeholder="Uptime (%)" value="{{ $KPI->MFG_UPTIME }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Loading time (Min/pack)</label>
                                    <input type="text" name="MFG_LOADINGTIME" class="form-control form-control-danger" placeholder="Loading time (Min/pack)" value="{{ $KPI->MFG_LOADINGTIME }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Unloading (Min/pack)</label>
                                    <input type="text" name="MFG_UNLOADING" class="form-control form-control-danger" placeholder="Unloading (Min/pack)" value="{{ $KPI->MFG_UNLOADING }}">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row p-t-20">
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <label class="control-label">Scrap (Ton)</label>
                                    <input type="text" name="OUT_COST" class="form-control form-control-danger" placeholder="Scrap (Ton)" value="{{ $KPI->OUT_COST }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Scrap (%)</label>
                                    <input type="text" name="MFG_SCRAP_PER" class="form-control form-control-danger" placeholder="Scrap (%)" value="{{ $KPI->MFG_SCRAP_PER }}">
                                </div>    
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Overtime (%)</label>
                                    <input type="text" name="MFG_OVERTIME" class="form-control form-control-danger" placeholder="Overtime (%)" value="{{ $KPI->MFG_OVERTIME }}">
                                </div>    
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Productivity (ml/h)</label>
                                    <input type="text" name="MFG_PRODUCTIVITY" class="form-control form-control-danger" placeholder="Productivity (ml/h)" value="{{ $KPI->MFG_PRODUCTIVITY }}">
                                </div>    
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Labour Utilisation (%)</label>
                                    <input type="text" name="MFG_LABOUR_UTILI" class="form-control form-control-danger" placeholder="Labour Utilisation (%)" value="{{ $KPI->MFG_LABOUR_UTILI }}">
                                </div>    
                            </div>

                        </div>
                        <!--/row-->
                        <div class="row p-t-20">
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">Production on Time - POT (%)</label>
                                    <input type="text" name="MFG_POT" class="form-control form-control-danger" placeholder="Production on Time - POT (%)" value="{{ $KPI->MFG_POT }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Coversion cost (Mil)</label>
                                    <input type="text" name="MFG_COVERSION_COST_MIL" class="form-control form-control-danger" placeholder="Coversion cost (Mil)" value="{{ $KPI->MFG_COVERSION_COST_MIL }}">
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