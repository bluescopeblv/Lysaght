<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\User;
use Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $data['title'] = "Test L3";

        Mail::send('emails.email', $data, function($message) {
            $message->from('l3lysaght.svr01@gmail.com', 'Pre-L3 Project');
            $message->to('phuc.truong@bluescope.com', 'Truong, Phuc')
                    ->subject('Xin chào');
        });
        dd("Mail Sent successfully");

    }

    public function getSendMailFeedback()
    {
        $data['title'] = "PHẢN HỒI TỪ OPERATOR";
        $data['workcenter'] = "Purlin400";
        $data['ngay'] = "12-Sep-2018";
        $data['noidung'] = "Noi dung";

        $data['ngay'] = date('d-M-Y');
        $data['name'] = "abc";
        $data['sdt'] = "123";
        

        Mail::send('emails.email', $data, function($message) {
            $message->from('l3lysaght.svr01@gmail.com', 'Pre-L3 Project');
            $message->to('phuc.truong@bluescope.com', 'Truong, Phuc')
                    ->subject('PRE-L3: FEEDBACK');
        });
    } 

    

}
