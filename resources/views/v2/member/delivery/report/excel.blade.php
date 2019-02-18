<!DOCTYPE html>
<html>
<head>
    <title>DELIVERY REPORT</title>
</head>
<body>
    <h3>DELIVERY REPORT</h3>
    <table id="myTable" class="table table-bordered table-striped color-bordered-table info-bordered-table hover-table">
        <thead>
            <tr>
                <th>Kế hoạch</th>
                <th>Dự án</th>
                <th>Giao hàng bởi</th>
                <th>Type</th>
                <th>Biển số xe</th>
                <th>Tên tài xế</th>
                <th>Nhà xe</th>
                <th>Tải trọng xe</th>
                <th>Chiều dài</th>
                <!--  -->
                
                <th>T/G chờ chất hàng (h)</th>
                <th>T/G chất hàng (h)</th>
                <th>T/G chờ DN (h)</th>
                <th>T/G chờ DO/ PXK (h)</th>
                <th>T/G chờ bàn giao DN (h)</th>
                <th><b>Tổng thời gian (h)</b></th>
                <th>Status</th>
                
            </tr>
        </thead>
        <tbody>
            
            @foreach($thongtinxe as $ttx)
            <tr>
                <td>{{date('d-m',strtotime($ttx->thoigiankehoach))}}</td>
                <td>{{ $ttx->khachhang }}</td>
                <td>{{ $ttx->giaohangboi }}</td>
                <td>{{ $ttx->loaihang }}</td>
                <td>{{ $ttx->bienso }}</td>
                <td>{{$ttx->tentaixe}}</td>
                <td>{{$ttx->nhaxe}}</td>
                <td>{{$ttx->taitrongxe}}</td>
                <td>{{$ttx->chieudaixe}}</td>
                <!--  -->
                
                <td>
                    {{ doithoigian(get_Delivery_ThoiGian_ChoChatHang($ttx->thoigianxevao,$ttx->thoigianbatdauchathang)) }}
                </td>
                <td>
                    {{ doithoigian(get_Delivery_ThoiGian_ChatHang($ttx->thoigianbatdauchathang,$ttx->thoigianketthucchathang)) }}
                </td>
                <td>
                    {{ doithoigian(get_Delivery_ThoiGian_ChoDN($ttx->thoigianketthucchathang, $ttx->thoigianxongDN)) }}
                </td>
                <td>
                    {{ doithoigian(get_Delivery_ThoiGian_ChoDO_PXK($ttx->thoigianketthucchathang,$ttx->thoigianxongPXK)) }}
                </td>
                <td>
                    {{ doithoigian(get_Delivery_ThoiGian_BanGiaoDN($ttx->thoigianketthucchathang,$ttx->thoigianxongDN, $ttx->thoigianbagiaoDN)) }}
                </td>

                <td>
                    {{ doithoigian(get_Delivery_TongThoiGian($ttx->thoigianxevao,$ttx->thoigianbatdauchathang, $ttx->thoigianketthucchathang, $ttx->thoigianxongDN, $ttx->thoigianxongPXK, $ttx->thoigianbagiaoDN )) }}
                </td>
                
                <td>{!! getDeliveryStatus($ttx->status) !!}</td>
                

            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>





