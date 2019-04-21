<!DOCTYPE html>
<html>
<head>
    <title>DELIVERY REPORT</title>
</head>
<body>
    <h4>DELIVERY REPORT <span style="color:green">Reporting time: {{ date('d-m-y')}}</span></h4>
    
    <table id="myTable" class="table table-bordered table-striped color-bordered-table info-bordered-table hover-table">
        <thead>
            <tr>
                <!-- 1 -->
                <th>Kế hoạch</th>
                <th>Thời gian xe vào</th>
                <th>Thời gian xe ra</th>
                <th>Dự án</th>
                <th>Giao hàng bởi</th>
                <th>Hàng dự án/Lẻ</th>
                <th>Biển số xe</th>
                <th>Tên tài xế</th>
                <th>Nhà xe</th>
                <th>Tải trọng xe (Tấn)</th>
                <th>Chiều dài (m)</th>
                <!-- 2 -->
                <th>Thời gian logistic xác nhận</th>
                <th>Chi tiết</th>
                <th>Logistic ghi chú</th>
                <th>Thời gian huấn luyện tài xế xong</th>
                <th>Thời gian bắt đầu chất hàng</th>
                <th>Thời gian chất hàng xong</th>
                <th>Thời gian hoàn thành DN</th>
                <th>Thời gian hoàn thành PXK</th>
                <th>Thời gian bàn giao DN</th>
                <!-- 3 -->
                <th>Sản phẩm</th>
                <th>Chiều dài hàng</th>
                <th>Số tấn</th>
                <th>Số kiện hàng</th>
                <th>Số dây ràng</th>
                <th>Giao hàng ghi chú</th>

                <!-- 4 -->
                <th>T/G chờ chất hàng (h:m)</th>
                <th>T/G chất hàng (h:m)</th>
                <th>T/G chờ DN (h:m)</th>
                <th>T/G chờ DO/ PXK (h:m)</th>
                <th>T/G chờ bàn giao DN (h:m)</th>
                <th><b>Tổng thời gian (h:m)</b></th>

                <!-- 5 -->
                <th>T/G chờ chất hàng (Số)</th>
                <th>T/G chất hàng (Số)</th>
                <th>T/G chờ DN (Số)</th>
                <th>T/G chờ DO/ PXK (Số)</th>
                <th>T/G chờ bàn giao DN (Số)</th>
                <th><b>Tổng thời gian (Số)</b></th>

                <!-- <th><b>Tổng thời gian (Số giờ)</b></th>
                <th><b>Tổng thời gian (Số phút)</b></th> -->
                <th>Status</th>
                <th>Thời gian nghỉ trưa/tối</th>
                
            </tr>
        </thead>
        <tbody>
            
            @foreach($thongtinxe as $ttx)
            <tr>
                <!-- 1 -->
                <td>{{ date('d-m-Y h:i:s',strtotime($ttx->thoigiankehoach)) }}</td>
                <td>{{ date('d-m-Y h:i:s',strtotime($ttx->thoigianxevao)) }}</td>
                <td>{{ date('d-m-Y h:i:s',strtotime($ttx->thoigianxera )) }}</td>
                <td>{{ $ttx->khachhang }}</td>
                <td>{{ $ttx->giaohangboi }}</td>
                <td>{{ $ttx->loaihang }}</td>
                <td>{{ $ttx->bienso }}</td>
                <td>{{$ttx->tentaixe}}</td>
                <td>{{$ttx->nhaxe}}</td>
                <td>{{$ttx->taitrongxe}}</td>
                <td>{{$ttx->chieudaixe}}</td>
                <!-- 2 -->
                <td>{{ date('d-m-Y h:i:s',strtotime($ttx->thoigianlogisticConfirm )) }}</td>
                <td>{{ getDeliveryDetail($ttx->id) }}</td>
                <td>{{ $ttx->notelogistic }}</td>
                <td>{{ date('d-m-Y h:i:s',strtotime($ttx->thoigianhuanluyen )) }}</td>
                <td>{{ date('d-m-Y h:i:s',strtotime($ttx->thoigianbatdauchathang )) }}</td>
                <td>{{ date('d-m-Y h:i:s',strtotime($ttx->thoigianketthucchathang )) }}</td>
                <td>{{ date('d-m-Y h:i:s',strtotime($ttx->thoigianxongDN )) }}</td>
                <td>{{ date('d-m-Y h:i:s',strtotime($ttx->thoigianxongPXK )) }}</td>
                <td>{{ date('d-m-Y h:i:s',strtotime($ttx->thoigianbagiaoDN )) }}</td>

                <!-- 3 -->
                <td>{{ $ttx->sanpham }}</td>
                <td>{{ $ttx->chieudai }}</td>
                <td>{{ $ttx->khoiluong }}</td>
                <td>{{ $ttx->sokien}}</td>
                <td>{{ $ttx->sodayrang}}</td>
                <td >{{ $ttx->noteproduction}}</td>

                <!-- 4 -->
                <td>
                    {{ doithoigian(get_Delivery_ThoiGian_ChoChatHang($ttx->thoigiankehoach, $ttx->thoigianxevao,$ttx->thoigianbatdauchathang)) }}
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

                <td style="color: blue">
                    {{ doithoigian(get_Delivery_TongThoiGian($ttx->thoigiankehoach, $ttx->thoigianxevao,$ttx->thoigianbatdauchathang, $ttx->thoigianketthucchathang, $ttx->thoigianxongDN, $ttx->thoigianxongPXK, $ttx->thoigianbagiaoDN )) }}
                </td>

                <!-- 5 -->
                <td >
                    {{ doithoigian_hhmmss(get_Delivery_ThoiGian_ChoChatHang($ttx->thoigiankehoach, $ttx->thoigianxevao,$ttx->thoigianbatdauchathang)) }}
                </td>
                <td  >
                    {{ doithoigian_hhmmss(get_Delivery_ThoiGian_ChatHang($ttx->thoigianbatdauchathang,$ttx->thoigianketthucchathang)) }}
                </td>
                <td  >
                    {{ doithoigian_hhmmss(get_Delivery_ThoiGian_ChoDN($ttx->thoigianketthucchathang, $ttx->thoigianxongDN)) }}
                </td>
                <td>
                    {{ doithoigian_hhmmss(get_Delivery_ThoiGian_ChoDO_PXK($ttx->thoigianketthucchathang,$ttx->thoigianxongPXK)) }}
                </td>
                <td>
                    {{ doithoigian_hhmmss(get_Delivery_ThoiGian_BanGiaoDN($ttx->thoigianketthucchathang,$ttx->thoigianxongDN, $ttx->thoigianbagiaoDN)) }}
                </td>

                <td style="color: blue">
                    {{ doithoigian_hhmmss(get_Delivery_TongThoiGian($ttx->thoigiankehoach, $ttx->thoigianxevao,$ttx->thoigianbatdauchathang, $ttx->thoigianketthucchathang, $ttx->thoigianxongDN, $ttx->thoigianxongPXK, $ttx->thoigianbagiaoDN )) }}
                </td>

                <!-- Đổi ra Giờ -->
                <!-- <td>
                </td>
                Đổi ra Phút
                <td>
                </td> -->
                
                <td>{!! getDeliveryStatus($ttx->status) !!}</td>
                <td>{{ checkTimeOff( $ttx->thoigianxevao, $ttx->thoigianxera ) }}</td>
                

            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>





