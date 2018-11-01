<style type="text/css">
	.content{
		color: blue;
	}

	.header{
		background-color: #00004d;
		color: white;
		text-align: center;
		margin-top: 10px;
	}
</style>
<div style="background-color: #f5d6eb;font-family: arial;">
	<h3 class="header">{{ $title }}</h3>
	<br>
	
	<p>Nhân viên tiếp nhận:  <span style="color: blue">{{ $name }}</span> SĐT: <span style="color: blue">{{ $sdt }}</span></p>
	<hr>

	<p>Khách hàng, dự án:  <span class="content">{{ $khachhang }}</span></p>
	<p>Tên tài xế: <span class="content">{{ $tentaixe }}</span> 
		Biển số: <span class="content">{{ $bienso }}</span>
	</p>
	<p>Nhà xe:  <span style="color: blue">{{ $nhaxe }}</span>
		Tải trọng xe: <span class="content">{{$taitrongxe}} tấn</span>
	</p>
	
	<p>Thời gian đến: <span class="content">{{$thoigianxevao}}</span></p>

	<p style="background-color: #00004d; color: white">Đây là email được gửi tự động từ hệ thống PRE-L3. Vui lòng không reply email này. Nếu có thắc mắc vui lòng liên hệ Phúc.</p>
</div>









