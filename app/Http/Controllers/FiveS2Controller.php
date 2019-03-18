<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LoaiKhiemKhuyet;
use App\DefectList;
use Mail;
use App\Workcenter;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Charts\SampleChart;
use App\Question;
use App\QuestionGroup;
use App\Nhanvien;
use App\NhanvienGroup;
use App\Campaign;
use App\Chamdiem;
use App\Chitiet;
use App\FSGroup;


class FiveS2Controller extends Controller
{
    //---------------------------------------------------------
    //-Pages FS GROUP
    public function getList_FSGroup()
    {
        $groups = FSGroup::all();        
        return view('v2.member.fives.fsgroup.list',compact('groups'));
    }
    
    public function getAdd_FSGroup()
    {
        return view('v2.member.fives.fsgroup.add');
    }

    public function postAdd_FSGroup(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'name.required'=>'* Bạn chưa nhập tên',
        ]);

        $group = new FSGroup;
        $group->name = $request->name;
        $group->note = $request->note;
        $group->save();

        return redirect()->back()->with('thongbao','Đã thêm thành công');
    }

    public function getEdit_FSGroup($id)
    {
        $group = FSGroup::find($id);
        return view('v2.member.fives.fsgroup.edit',compact('group'));
    }

    public function postEdit_FSGroup($id, Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ],
        [
            'name.required'=>'* Bạn chưa nhập tên',
        ]);

        $group = FSGroup::find($id);

        $group->name = $request->name;
        $group->note = $request->note;

        $group->save();

        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    public function getDelete_FSGroup($id)
    {
        // $nhanvien = Nhanvien::find($id);
        // $nhanvien->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');;
    }

//---------------------------------------------------------
//  V2 - RESULT
//---------------------------------------------------------
    public function getList_Result($campaign_id)
    {
        $campaignName = Campaign::find($campaign_id)->name;
        $groups = FSGroup::all();        
        return view('v2.member.fives.kqgroup.list',compact('groups','campaign_id','campaignName'));
    }

    
//***************************************************************************
// V2 - Campaign
//***************************************************************************
    
    public function getList_Campaign()
    {
        $campaign = Campaign::all();        
        return view('v2.member.fives.campaign.list',compact('campaign'));
    }


    
}
