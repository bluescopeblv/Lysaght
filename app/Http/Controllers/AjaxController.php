<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\KeHoach;

class AjaxController extends Controller
{
    public function getLoaiTin($idTheLoai)
    {
    	$loaitin = LoaiTin::where('idTheLoai',$idTheLoai)->get();
        foreach ($loaitin as $lt) {
            echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
        }
    
    }

    public function getChiTietCO($id)
    {
    	$chitiet = KeHoach::find($id);
        
	    echo "<td style='color: blue'>$chitiet->MO</td>";
		echo "<td style='color: blue'>$chitiet->SL</td>";
		echo "<td style='color: blue'>$chitiet->ChieuDai</td>";
		echo "<td style='color: blue'>$chitiet->KL</td>";
		echo "<td class='center'  id='reportXong'><a href='reportXong/$id' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-floppy-saved'></span> XONG</a>
        </td>";
		echo "<td class=\"center\">
				<form action=\"reportMotPhan/$id\" method=\"POST\"  >
				<input type=\"hidden\" name='_token' value=\"".csrf_token()."\" />

                <input name='soluong' class='form-control' placeholder=\"Số lượng\" style='width: 25%; display:inline' />
                <button style='while-space:nowrap, width: 50px' type=\"submit\" class=\"btn btn-default\">1 PHẦN</button>
                </form>
            </td>";
    
    }

    public function getReportXong($id)
    {
    	$chitiet = KeHoach::find($id);
    	$chitiet->DaSX2 = 1;
    	if($chitiet->SLDaSX > 0)
    	{
    		$chitiet->SLDaSX_1 = $chitiet->SLDaSX;
    	}
    	$chitiet->SLDaSX = NULL;
        $chitiet->NgaySX_TT = date('Y-m-d');
    	$chitiet->save();

    	return redirect()->back()->with('thongbao','Bạn đã báo cáo thành công');
    }

    public function postReportMotPhan(Request $request,$id)
    {
    	$chitiet = KeHoach::find($id);
    	$chitiet->DaSX2 = NULL;
    	if($request->soluong == 0){
    		$chitiet->SLDaSX = NULL;
    	}
    	elseif($request->soluong < $chitiet->SL )
    		{$chitiet->SLDaSX = $request->soluong;}
    	

    	$chitiet->save();

        return redirect()->back()->with('thongbao','Bạn đã báo cáo thành công');

    	//return redirect("chitiet/".$chitiet->CO."/".$chitiet->Litem)->with('thongbao','Bạn đã báo cáo thành công');
    }

    public function getRealTime()
    {
        echo date('Y-m-d H:i:s');
    }

    
}
