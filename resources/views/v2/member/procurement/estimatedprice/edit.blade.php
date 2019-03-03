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
                <span class="tieude">PROCUREMENT - EDIT <span style="color: green">{{ $estiprice->updated_at }}</span></span>
                <span style="float:right; display: block">
                <a href="procurement/estimatedprice">
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
                <form action="procurement/estimatedprice/edit/{{ $estiprice->id }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <div class="panel-group">
                        <div class="panel panel-info">
                            <div class="panel-heading">Thêm mới</div>
                            <div class="panel-body">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Crane 45T factory VND</label>
                                        <input type="text" name="crane_45_factory" class="form-control" placeholder="Crane 45T factory" value="{{ $estiprice->crane_45_factory }}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Crane 45T site VND</label>
                                        <input type="text" name="crane_45_site" class="form-control form-control-danger" placeholder="Crane 45T site" value="{{ $estiprice->crane_45_site }}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Crane 8T VND</label>
                                        <input type="text" name="crane_8_site" class="form-control form-control-danger" placeholder="Crane 8T" value="{{ $estiprice->crane_8_site }}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Crane Liftjack VND</label>
                                        <input type="text" name="crane_liftjack" class="form-control form-control-danger" placeholder="Crane Liftjack" value="{{ $estiprice->crane_liftjack }}">
                                    </div>
                                </div>
                                <!--/span-->
                                
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Genset hiring VND</label>
                                        <input type="text" name="genset_hiring" class="form-control form-control-danger" placeholder="Genset hiring" value="{{ $estiprice->genset_hiring }}">
                                    </div>    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Fuel for genset VND</label>
                                        <input type="text" name="fuel_genset" class="form-control form-control-danger" placeholder="Fuel for genset" value="{{ $estiprice->fuel_genset }}">
                                    </div>    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Đấu nối điện at site VND</label>
                                        <input type="text" name="daunoidien" class="form-control form-control-danger" placeholder="Đấu nối điện at site" value="{{ $estiprice->daunoidien }}">
                                    </div>    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Điện công trường VND</label>
                                        <input type="text" name="electric_site" class="form-control form-control-danger" placeholder="Điện công trường" value="{{ $estiprice->electric_site }}">
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Machine Insurance VND</label>
                                        <input type="text" name="machines_insurance" class="form-control form-control-danger" placeholder="Machine Insurance" value="{{ $estiprice->machines_insurance }}">
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Labour cost VND</label>
                                        <input type="text" name="labour_cost" class="form-control form-control-danger" placeholder="Labour cost" value="{{ $estiprice->labour_cost }}">
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Health check VND</label>
                                        <input type="text" name="health_check" class="form-control form-control-danger" placeholder="Health check" value="{{ $estiprice->health_check }}">
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Safety training cert VND</label>
                                        <input type="text" name="safety_certificate" class="form-control form-control-danger" placeholder="Safety training certificate" value="{{ $estiprice->safety_certificate }}">
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Insurance VND</label>
                                        <input type="text" name="insurance" class="form-control form-control-danger" placeholder="Insurance" value="{{ $estiprice->insurance }}">
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Technician VND</label>
                                        <input type="text" name="technician" class="form-control form-control-danger" placeholder="Technician" value="{{ $estiprice->technician }}">
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Timber packaging VND</label>
                                        <input type="text" name="timber" class="form-control form-control-danger" placeholder="Timber packaging" value="{{ $estiprice->timber }}">
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Safety tools VND</label>
                                        <input type="text" name="safety_tool" class="form-control form-control-danger" placeholder="Safety tools" value="{{ $estiprice->safety_tool }}">
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Covering nylon VND</label>
                                        <input type="text" name="covering_nylon" class="form-control form-control-danger" placeholder="Covering nylon" value="{{ $estiprice->covering_nylon }}">
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Security (VND)</label>
                                        <input type="text" name="security" class="form-control form-control-danger" placeholder="Security" value="{{ $estiprice->security }}">
                                    </div>
                                </div>
                                <!--/row-->
                                
                            </div>
                        </div>
                        </div>

                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Sửa</button>
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