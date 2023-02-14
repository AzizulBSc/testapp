<?php

namespace App\Http\Controllers;

use Exception;
// use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{

    public function sms()
    {
        return view('sms.sms');
    }
    public function send_sms(Request $request)
    {
        $to_phone = "+8801304071651";
        $message = $request->body;


        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($to_phone, [
                'from' => $twilio_number,
                'body' => $message
            ]);
            dd('SMS Sent Successfully.');
        } catch (Exception $e) {
            dd("Error: " . $e->getMessage());
        }
        // $sid = getenv("TWILIO_SID");
        // $auth_token = getenv("TWILIO_TOKEN");
        // $from_phone = getenv("TWILIO_FROM");
        // // try {
        // $client = new Client($sid, $auth_token);
        // $client->message->create($to_phone, ['from' => $from_phone, 'body' => $message]);
        // return "Sms Sent Successfully";
        // // } 
        // // catch (Exception $e) {
        // //     return $e;
        // // }
    }
}
