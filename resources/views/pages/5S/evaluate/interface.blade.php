@extends('layout.index')

@section('content')
<div class="container">
    <div class="panel panel-primary ">
        <div class="panel-heading">5S | Đánh giá </div>
        <div class="panel-body">
            <div class="button button1"><a href="fives/evaluate/campaign">ĐỢT ĐÁNH GIÁ</a></div>

           	<div class="button button1"><a href="fives/evaluate/nhanvien-group">NHÓM NHÂN VIÊN</a></div>
           	<div class="button button1"><a href="fives/evaluate/nhanvien">NHÂN VIÊN</a></div>
           	

        </div>
    </div>
    <div class="panel panel-success ">
        <div class="panel-heading">5S | REPORT </div>
        <div class="panel-body">
            <div class="button button1"><a href="fives/report">Chi tiết</a></div>
           	<div class="button button1"><a href="fives/report/chart-campaign">Chart theo group</a></div>
           	<div class="button button1"><a href="fives/report/chart-group">Chart theo nhân viên</a></div>
           	

        </div>
    </div>
</div>
@endsection
@section('script')

@endsection