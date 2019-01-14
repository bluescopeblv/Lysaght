@extends('layout.index_fontend')


@section('content')
<div class="container-fluid">
    <marquee><h4><span class="fa fa-truck" style="color: red"></span> THÔNG TIN GIAO HÀNG </h4></marquee>
    <div class="panel panel-success">
        <div class="panel-heading">Hôm nay ngày {{date('d-M-Y')}} <span><div id="displayTime"></div></span></div>

        <div class="panel-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle">
                        </h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr style="font-size: 22px;color: blue">
                                        <th>Kế hoạch</th>
                                        <th>Thời gian xe vào</th>
                                        <th>Dự án</th>
                                        <th>Biển số</th>
                                        <th>Tải trọng xe</th>
                                        <th>So CO</th>
                                        <th>Status</th>
                                        <th>Thời gian dự kiến xong</th>             
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($thongtinxe as $ttx)
                                    <tr style="font-size: 20px">
                                        <td>
                                            @if($ttx->thoigiankehoach == NULL)

                                            @else
                                            <span><i class="fa fa-clock-o"></i> {{ date('d-m-Y H:i',strtotime($ttx->thoigiankehoach)) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($ttx->thoigianxevao == NULL)

                                            @else
                                            <span><i class="fa fa-clock-o"></i> {{ date('H:i',strtotime($ttx->thoigianxevao)) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class=""><i class="fa fa-group"></i> {{ $ttx->khachhang }}</span>
                                        </td>
                                        <td>
                                            <span class=""><i class="fa fa-car"></i> {{ $ttx->bienso }}</span>
                                        </td>
                                        <td>{{$ttx->taitrongxe}} Tấn</td>
                                        <td> 
                                            <a href="delivery/logistic/detailco/{{$ttx->id}}">{{ getSoLuongCO($ttx->id) }}</a> 
                                        </td>
                                        <!-- <td>{{ getDeliveryCO($ttx->id) }} -->
                                         
                                        </td>

                                        <!-- <td>
                                            <div class="label label-table label-success">Paid</div>
                                        </td> -->
                                        <td>
                                            {!! getDeliveryStatus($ttx->status) !!}
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

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
	                "visible": false,
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
<script type="text/javascript">
    $(document).ready(function() {
       // load_ajax();

    })
    
    function load_ajax(){
        $.ajax({
            url : "delivery/interface/time", // gửi ajax đến file result.php
            type : "get", // chọn phương thức gửi là post
            dataType:"text", // dữ liệu trả về dạng text
            success : function (result){
                // Sau khi gửi và kết quả trả về thành công thì gán nội dung trả về
                // đó vào thẻ div có id = result
                $('#displayTime').html(result);
            }
        });
        setInterval(load_ajax(), 1000);
   }

</script>

    <style type="text/css">
        body{
            padding-top: 20;
        }

    </style>

@endsection