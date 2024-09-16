<?php

namespace App\Http\Controllers;

// use Illuminate\Contracts\Session\Session as SessionSession;
use Session; // Correct import for the Session facade
use Stripe;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    //
public function stripe(){
    return view('stripe');
}
public function stripePost(Request $request){
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    Stripe\Charge::create([
        "amount" => 100*100,
        "currency" => "usd",
        "source" => $request->stripeToken,
        "description" => "New Order Payment Received Successfully"
    ]);
    Session::flash('success', 'Payment successful!');
    return back();
    
   

}
   
}
