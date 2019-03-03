@extends('v2.member.layout.index')
@section('css')
<!-- ===== Plugin CSS ===== -->
<link href="v2/member/plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
#myTable{
    font-family: "Arial";
    color: black;
}

.tieude{
    font-family: "Arial";
    color: blue;
    font-size: 20px;
    font-style: bold;
}

#playlist{background:#666;padding:20px;}
#audio{background:#666;padding:20px; width: 100%}
.active a{color:#5DB0E6;text-decoration:none;}
li a{color:#eeeedd;padding:5px;display:block;}
li a:hover{text-decoration:none;}

</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-body">
                <span class="tieude">MUSIC - ACTIVITY</span>
                <span style="float:right; display: block">
                <a href="music/activity/add">
                    <button type="button" class="btn btn-warning d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Thêm bài hát vào phát </button></a></span>
            </div>
        </div>
    </div>
</div>

<!-- /row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}           
                </div>
            @endif

            
            <audio controls="" autoplay>
              <source src="upload\music\lib\a.mp3" type="audio/mpeg">
              Your browser does not support the audio element.
            </audio>

            <div class="table-responsive m-t-40">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên bài hát</th>
                            <th>Thời gian bắt đầu</th>
                            <th>Thời gian kết thúc</th>
                            <th>User</th>
                            <th>Active</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($songs as $key => $val)
                        <tr>
                            <td>{{$val->id}}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->start}}</td>
                            <td>{{$val->updated_at}}</td>
                            <td>
                                <span class="label label-warning">
                                    <a href="music/edit/{{$val->id}}"><span class="glyphicon glyphicon-edit">Sửa</span></a>
                                </span><span>  </span>
                                
                                <span class="label label-danger">
                                    <a href="music/delete/{{$val->id}}"><span class="glyphicon glyphicon-remove-sign">Xóa</span></a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                <ul id="playlist">
                    <li class="active"><a href="http://www.archive.org/download/bolero_69/Bolero.mp3">Ravel Bolero</a></li>
                    <li><a href="http://www.archive.org/download/MoonlightSonata_755/Beethoven-MoonlightSonata.mp3">Moonlight Sonata - Beethoven</a></li>
                    <li><a href="http://www.archive.org/download/CanonInD_261/CanoninD.mp3">Canon in D Pachabel</a></li>
                    <li><a href="http://www.archive.org/download/PatrikbkarlChamberSymph/PatrikbkarlChamberSymph_vbr_mp3.zip">patrikbkarl chamber symph</a></li>

                </ul>
                <!-- <audio id="audio" preload="auto" tabindex="0" controls="" type="audio/mpeg" allow="autoplay" >
                    <source type="audio/mp3" src="upload\music\lib\a.mp3">
                    Sorry, your browser does not support HTML5 audio.
                </audio> -->

                

        </div>
    </div>
</div>
<!-- http://devblog.lastrose.com/html5-audio-video-playlist/
 -->

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
<!-- <script type="text/javascript">
    var audio;
    var playlist;
    var tracks;
    var current;

    //init();
    //run_auto();

    function init(){
        current = 0;
        audio = $('audio');
        playlist = $('#playlist');
        tracks = playlist.find('li a');
        len = tracks.length - 1;
        audio[0].volume = .70;
        playlist.find('a').click(function(e){
            e.preventDefault();
            link = $(this);
            current = link.parent().index();
            run(link, audio[0]);
        });
        audio[0].addEventListener('ended',function(e){
            current++;
            if(current == len){
                current = 0;
                link = playlist.find('a')[0];
            }else{
                link = playlist.find('a')[current];    
            }
            run($(link),audio[0]);
        });
    }
    function run(link, player){
            player.src = link.attr('href');
            par = link.parent();
            par.addClass('active').siblings().removeClass('active');
            audio[0].load();
            audio[0].play();
    }

    function run_auto(){
            audio = $('audio');
            audio[0].load();
            audio[0].autoplay = true;
            //audio[0].play();
    }
</script> -->
@endsection