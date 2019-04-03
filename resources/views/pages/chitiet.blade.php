@extends('layout.index')

@section('content')
	<style>
		.current { color: red; font-weight: bold; }

		.detail_CO {font-size: 20px; color: yellow }
	</style>

    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">

            </div>
            <div class="col-md-25">
                <div class="panel panel-primary">
				  	<div class="panel-heading">CHI TIẾT CO: <span class="detail_CO " >{{$CO}} </span>  - LITEM: <span class="detail_CO " >{{$Litem}}</span> - NGÀY SẢN XUẤT: <span class="detail_CO " >{{date('d-M-Y', strtotime($DateSX_KH_DMY))}}</span> - THỨ TỰ CHẠY: <span class="detail_CO " >{{$ThuTuCO}}</span></div>
				  	<div class="panel-body">
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
				    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
          
		                    <thead>
		                        <tr align="center">
		                        	<th hidden=""><input type="checkbox" id="checkbox"></th>

		                            <th hidden="">ID</th>
		                            <th>MO</th>
		                            <th>Mark</th>
		                            <th>Mô tả </th>
		                            <th>Màu sắc</th>
		                            <th>Citem</th>
		                            <th>Số lượng</th>
		                            <th>Chiều dài</th>
		                            <th>Khối lượng</th>
		                            <th>Priority</th>
		                            <th>Note</th>
		                            <th>Đã xong</th>
		                            <th>SLSX</th>
		                            <th hidden="">Feedback</th>
		                            <th>Chi tiết</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	@if(isset($chitietCO))
			                        @foreach($chitietCO as $ct)
			                        <tr class="odd gradeX" align="center">
			                        	<td hidden=""><input type="checkbox" ></td>
			                            <td hidden="" id="id" class="id">{{$ct->id}}</td>
			                            <td>{{$ct->MO}}</td>
			                            <td>{{$ct->Mark}}</td>
			                            <td>{{str_replace("---","",str_replace("------","",$ct->DescriptionS))}}</td>
			                            <td>{{$ct->Color}}</td>
			                            <td>{{$ct->Citem}}</td>
			                            <td>{{$ct->SL}}</td>
			                            <td>{{number_format($ct->ChieuDai,0,"." , " ")}}</td>
			                            <td>{{number_format($ct->KL,4,"." , ",")}}</td>
			                            <td>{{$ct->Priority1}}</td>
			                            <td>{{$ct->Note1}}</td>

			                            @if($ct->DaSX2 == 1)
			                            	<td style="color: green">{{"Sản xuất xong"}}</td>
			                            @elseif($ct->SLDaSX > 0)
			                            	<td style="color: blue">{{"Đang sản xuất"}}</td>
			                            @else
			                            	<td>{{"Chưa"}}</td>
			                            @endif
			                            <td>{{$ct->SLDaSX}}</td>
			                            <td hidden="">{{$ct->Note2}}</td>
			                            <td class="center"><i class="glyphicon glyphicon-pencil"></i>...</td>
			                        </tr>
			                        @endforeach
			                    @endif

		                    </tbody>
		                    <!-- Phân trang -->
						  		
		                </table>
		                	<div style="text-align: center;">
				                {{$chitietCO->links()}}
				            </div>			   
				  	</div>
				  	<div class="panel-footer">
				  		<a href="chitiet/{{$CO}}/{{$Litem}}/{{$wc}}/{{ $DateSX_KH_DMY }}/{{ $ThuTuCO}}/reportall">REPORT ALL</a> 
				  	</div>
				</div>
            </div>

            <div class="col-md-20">
                <div class="panel panel-info">
				  	<div class="panel-heading">CHI TIẾT MO:  REPORT ALL</div>
				  	<div class="panel-body">
				  		
				    	<table class="table table-striped table-bordered table-hover" id="dataTables">
		                    <thead>
		                        <tr align="center">
		                            <th>MO</th>
		                            <th>Số lượng</th>
		                            <th>Chiều dài</th>
		                            <th>Khối lượng</th>
		                            <th>Báo cáo</th>
		                            <th>Xong 1 phần</th>
		                        </tr>
		                    </thead>
		                    <tbody>                       
		                        <tr class="odd gradeX" align="center" id="table_details">

		                        </tr>
		                    </tbody>
		                </table>	
				  	</div>

				</div>
            </div>


            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>

@endsection

@section('script')
	<script>
		$(document).ready(function() {
			//alert("Dã chạy");
			$('#dataTables-example tr.odd ').click(function(){
		        $('tr').removeClass();
		        $(this).addClass('current');

		        //var id = $('#id').find('td:nth-child(1)').text();
		        var id = $(this).find(".id").html();
		        //alert(id);
		        
		        $.get("chitiet/"+id,function(data) {
			 		$("#table_details").html(data);
			 	});

			 	
		    });

		    $('#reportXong').click(function(){
			    $.get("reportXong/"+id,function() {
				 		
				 });
			});

			$('#checkbox').click(function (e) {
			    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
			});
		});

	</script>
@endsection