<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function charge(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $request->amount,
                'currency' => 'usd',
                'source' => $request->stripeToken,
            ]);
        } catch (Exception $e) {
            // The card has been declined
            return back()->withErrors('Error: '.$e->getMessage());
        }

        // Payment succeeded, do something here (e.g. save the transaction to your database)

        return redirect()->route('payment.success');
    }

    public function createPayment(Type $var = null)
    {
        return 'test';
    }

    public function token()
    {
        session_start();

        $request_token = $this->_bkash_Get_Token();

        $idtoken = $request_token['id_token'];

        $_SESSION['token'] = $idtoken;
        // $strJsonFileContents = file_get_contents("config.json");
        // $array = json_decode($strJsonFileContents, true);
        $array = $this->_bkash_Get_Token();
        $array['token'] = $idtoken;

        $newJsonString = json_encode($array);
        file_put_contents('config.json', $newJsonString);

        echo $idtoken;
    }

    protected function _bkash_Get_Token()
    {

        // $strJsonFileContents = file_get_contents("config.json");
        // $array = json_decode($strJsonFileContents, true);
        $array = $this->_get_config_file();

        $post_token = [
            'app_key' => $array['app_key'],
            'app_secret' => $array['app_secret'],
        ];

        $url = curl_init($array['tokenURL']);
        $proxy = $array['proxy'];
        $posttoken = json_encode($post_token);
        $header = [
            'Content-Type:application/json',
            'password:'.$array['password'],
            'username:'.$array['username'],
        ];

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $posttoken);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($url, CURLOPT_PROXY, $proxy);
        $resultdata = curl_exec($url);
        curl_close($url);

        return json_decode($resultdata, true);
    }

    protected function _get_config_file()
    {
        $path = storage_path().'/app/public/config.json';

        return json_decode(file_get_contents($path), true);
    }
}
