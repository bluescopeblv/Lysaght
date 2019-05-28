<!DOCTYPE html>
<html>
<head>
    <title>MAINTENANCE REPORT</title>
</head>
<body>
    <h4>MAINTENANCE REPORT <span style="color:green">Reporting time: {{ date('d-m-y')}}</span></h4>
    
    <table id="myTable" class="table table-bordered table-striped color-bordered-table info-bordered-table hover-table">
        <thead>
            <tr>
                <!-- 1 -->
                <th>#</th>
                <th>Thời gian hư hỏng</th>
                <th>Loại</th>
                <th>Máy</th>
                <th>Nội dung </th>
                <!-- 2 -->
                <th>Giải pháp</th>
                <th>Note</th>
                <th>Created_at</th>

                
            </tr>
        </thead>
        <tbody>
            
            @foreach($activities as $key => $val)
            <tr>
                <!-- 1 -->
                <td>{{ $val->id }}</td>
                <td>{{ date('d-m-Y',strtotime($val->date)) }}</td>
                <td>{{ $val->outs_maint_type->name }}</td>
                <td>{{ $val->outs_maint_machine->name }}</td>
                <td>{{ $val->content }}</td>
                <!-- 2 -->
                <td>{{ $val->solution }}</td>
                <td>{{ $val->note }}</td>
                <td>{{ $val->created_at }}</td>

                
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>





