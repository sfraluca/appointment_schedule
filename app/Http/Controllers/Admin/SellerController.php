<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function create() 
    {
        $user = Auth::user();
        if(!is_null($user->stripe_connect_id)) {
            return redirect()->route('stripe.login');
        }

        $session = \request()->session()->getId();

        $url = config('services.stripe.connect') . $session;
        return redirect($url);
    }

    public function save(Request $request) 
    {
        $this->validate($request, [
            'code' => 'required',
            'state' => 'required'
        ]);
        $session = DB::table('sessions')->where('id', '=', $request->state)->first();
        if(is_null($session)) {
            return redirect()->route('/')->with('error', 'state not found');
        }

        $data = Seller::create($request->code);
        User::find($session->user_id)->update(['stripe_connect_id' => $data->stripe_user_id]);
        return redirect()->route('/')->with('success', 'Account information has been saved.');
    }
    public function login() 
    {
        $user = Auth::user();
        Stripe::setApiKey(confih('serivesc.stripe.secret'));
        $account_link = Account::createLoginLink($user->stripe_connect_id);
        return redirect($account_link->url);
    }


}
