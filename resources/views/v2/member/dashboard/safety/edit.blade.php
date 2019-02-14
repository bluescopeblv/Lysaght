@extends('layout.index')

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

@endsection
@section('content')
<div class="container">
<!-- Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white"><a href="dashboard/safety">Danh sách</a></h4>
            </div>
            <div class="card-body">
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
                <form action="dashboard/safety/edit/{{$safety->id}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <h3 class="card-title">Thông tin Safety</h3>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">LTI (Only Lysaght)</label>
                                    <input type="text" id="LTI" name="LTI" class="form-control" placeholder="LTI Date" value="{{date('d-M-Y',strtotime($safety->LTI)) }}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <label class="control-label">MTI (Only Lysaght)</label>
                                    <input type="text" id="MTI" name="MTI" class="form-control form-control-danger" value="{{date('d-M-Y',strtotime($safety->MTI)) }}">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                            
                    </div>
                    <!--/row-->
                                        
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Edit</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Row -->
</div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
  $( function() {
    //$("#datepicker").datepicker();
  } );
  </script>

    <script>
        $(function() {
        $( "#LTI" ).datepicker({
        dateFormat:"d-M-yy",
          altField: "#start-date",
          altFormat: "yy-mm-dd",
          //minDate:+0,
          //maxDate:"+1m",
          showAnim:"slide", 
        });
        });
    </script>
    <script>
        $(function() {
        $( "#MTI" ).datepicker({
        dateFormat:"d-M-yy",
          altField: "#start-date",
          altFormat: "yy-mm-dd",
          //minDate:+0,
          //maxDate:"+1m",
          showAnim:"slide", 
        });
        });
    </script>


@endsection