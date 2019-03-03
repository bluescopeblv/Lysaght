<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MusicInfo;
use App\MusicActivity;
use DB;
use Mail;
use Carbon\Carbon;

class MusicController extends Controller
{
//==========================================================================
//          MUSIC INFO
//==========================================================================
    public function getList_Info()
    {
    	$songs = MusicInfo::all();
    	return view('v2.member.music.list',compact('songs'));
    }

    public function getAdd_Info()
    {
    	return view('v2.member.music.add');
    }

    public function postAdd_Info(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required',
            'linkfile'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên bài hát',
            'linkfile.required'=>'Bạn chưa nhập link file',
        ]);

        $songs = new MusicInfo;
        $songs->name = $request->name;

        //Kiểm tra file
        if ($request->hasFile('linkfile')) {
            $file = $request->linkfile;

            $fullName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $fullNameLenght = strlen($fullName);
            $extensionLenght = strlen($extension);
            $nameLength = $fullNameLenght - ($extensionLenght + 1);
            $onlyName = substr($fullName, 0, $nameLength);

            $fileNewName = $onlyName.'_'.date('YmdHis').'.'.$file->getClientOriginalExtension();

            $file->move('upload/music/lib',$fileNewName);
            $songs->linkfile = $fileNewName;
        }
       
        $songs->save();
        return redirect()->back()->with('thongbao','Thêm thành công');
    }

    public function getEdit_Info($id)
    {
    	$song = MusicInfo::find($id);
    	return view('v2.member.music.edit',compact('song'));
    }

    public function postEdit_Info(Request $request,$id)
    {
    	$this->validate($request,[
            'name' => 'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên bài hát',
        ]);

        $song = MusicInfo::find($id);
        $song->name = $request->name;
        
       
        $song->save();
        return redirect()->back()->with('thongbao','Sửa thành công');
    }

    public function getDelete_Info($id)
    {
        $song = MusicInfo::find($id);   
        $song->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }

//==========================================================================
//          MUSIC ACTIVITY
//==========================================================================
    public function getList_Acti()
    {
        $songs = MusicActivity::all();
        return view('v2.member.music.activity.list',compact('songs'));
    }

    public function getAdd_Acti()
    {
        $songs = MusicInfo::all();
        return view('v2.member.music.activity.add', compact('songs'));
    }

    public function postAdd_Acti(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'linkfile'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên bài hát',
            'linkfile.required'=>'Bạn chưa nhập link file',
        ]);

        $songs = new MusicInfo;
        $songs->name = $request->name;

        //Kiểm tra file
        if ($request->hasFile('linkfile')) {
            $file = $request->linkfile;

            $fullName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $fullNameLenght = strlen($fullName);
            $extensionLenght = strlen($extension);
            $nameLength = $fullNameLenght - ($extensionLenght + 1);
            $onlyName = substr($fullName, 0, $nameLength);

            $fileNewName = $onlyName.'_'.date('YmdHis').'.'.$file->getClientOriginalExtension();

            $file->move('upload/music/lib',$fileNewName);
            $songs->linkfile = $fileNewName;
        }
       
        $songs->save();
        return redirect()->back()->with('thongbao','Thêm thành công');
    }


//==========================================================================
//          MUSIC PLAY
//==========================================================================
    public function getList_Play()
    {
        $songs = MusicActivity::all();
        return view('v2.member.music.play.playlist',compact('songs'));
    }

}