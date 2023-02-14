<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// use Mail;
use app\Mail\MailNotify;
use App\Mail\SendMail;

class MailController extends Controller
{

    public function index()
    {

        $data = [
            'subject' => 'Laravel Mail Test',
            'body' => 'Hello This is my email Delivery Body Successfully'
        ];
        try {
            Mail::to('c173065@ugrad.iiuc.ac.bd')->send(new MailNotify($data));
            return response()->json(['Oh nice Check your Mail Box']);
        } catch (\Exception $th) {
            return response()->json(['Oh Sorry Something Wrong!!']);
        }
    }
    public function index1()
    {
        return view('emails.index');
    }
    public function send(Request $request)
    {
        $data = [$request->name, $request->phone, $request->address, $request->body];
        $send_mail = "c173065@ugrad.iiuc.ac.bd";
        Mail::to($send_mail)->send(new SendMail($data));
        return "Mail sent Successfully";
    }
}
