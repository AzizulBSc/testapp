<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;
// use Stripe;
use Cartalyst\Stripe\Stripe;
class StripeController extends Controller
{
     public function index()
     {
       return view('stripe.index');
     }
    public function process(Request $request)
    {

        $stripe = Stripe::charges()->create([
            'source' => $request->get('tokenId'),
            'currency' => 'USD',
            'amount' => $request->get('amount') * 100
        ]);

        return $stripe;
    }
}
