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
                <span class="tieude">PROCUREMENT - EDIT <span style="color: green">{{ $product->name }}</span></span>
                <span style="float:right; display: block">
                <a href="procurement/product">
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
                <form action="procurement/product/edit/{{ $product->id }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <div class="panel-group">
                        <div class="panel panel-info">
                            <div class="panel-heading">SỬA</div>
                            <div class="panel-body">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tên sản phẩm</label>
                                        <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ $product->name }}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Khoảng cách tối thiểu giữa 2 công nhân (m)</label>
                                        <input type="text" name="distance_2_worker" class="form-control form-control-danger" placeholder="Khoảng cách tối thiểu giữa 2 công nhân" value="{{ $product->distance_2_worker }}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Số m2 sx/ngày (m2)</label>
                                        <input type="text" name="finishgood_per_day" class="form-control form-control-danger" placeholder="finishgood per day" value="{{ $product->finishgood_per_day  }}">
                                    </div>
                                </div>
                                <!--/row-->
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Dầu tiêu thụ/ ngày (lít)</label>
                                        <input type="text" name="fuel" class="form-control form-control-danger" placeholder="Dầu tiêu thụ" value="{{ $product->fuel  }}">
                                    </div>    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Gỗ/1000m2 (m3)</label>
                                        <input type="text" name="timber" class="form-control form-control-danger" placeholder="Gỗ/1000m2" value="{{ $product->timber }}">
                                    </div>    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">KG/M2</label>
                                        <input type="text" name="kg_per_m2" class="form-control form-control-danger" placeholder="KG/M2" value="{{ $product->kg_per_m2 }}">
                                    </div>    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">PCS Default</label>
                                        <input type="text" name="pcs_default" class="form-control form-control-danger" placeholder="PCS Default" value="{{ $product->pcs_default  }}">
                                    </div>    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Bạc lót (20m/1000m2)</label>
                                        <input type="text" name="covering_nylon" class="form-control form-control-danger" placeholder="Bạc lót" value="{{ $product->covering_nylon }}">
                                    </div>    
                                </div>
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