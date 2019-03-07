@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
 
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        @if(Auth::check())
        <div class="panel panel-info">
            <div class="panel-body">
                <span class="tieude" style="font-size: 20px">WELCOME - {{ Auth::user()->name }}</span>
                <!-- <span style="float:right; display: block">
                <a href="procurement/activity/add">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> New check </button></a></span> -->
            </div>
        </div>

        <div class="white-box">
            <div class="form-body">
                <div class="panel-group">
                <div class="panel panel-info">
                    <div class="panel-body">
                        
                        <div class="col-md-12" style="color: blue; font-size: 20px">
                            WELCOME TO NS BLUESCOPE LYSAGHT VIETNAM
                        </div>

                        <div class="col-md-12" style="color: green; font-size: 15px">
                            <br>
                            Please select function at left slide.
                        </div>
                    </div>
                </div>

                </div>
             
            </div>
        </div>
        @else

        @endif
    </div>
</div>

<!-- /row -->
<div class="row">
    

</div>



@endsection

@section('script')
 
@endsection