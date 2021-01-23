<?php
namespace App\Services\Stripe;

use Product;
use App\Payment;
use App\User;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Trnasfer;


class Transaction
{
    public static function create(User $user, Payment $payment) 
    {
      $amount = $payment->price;//product
      $payout = $amount * 0.90;
      Stripe::setApiKey(config('services.stripe.secret'));

      $charge = Charge::create([
        'amount' =>self::toStripeFormat($amount),
        'currency' => 'ron',
        'customer' => $user->stripe_customer_id,
        'description' =>$payment->name//product
      ]);

      Transfer::create([
        'amount' => self::toStripeFormat($payout),
        'currency' => 'ron',
        'source_transaction' => $charge->id,
        'destination' => $payment->seller->stripe_connect_id//product
      ]);

      //save transaction
      $payment = new Payment();
      $payment->customer_id = $user->id;
      $payment->product_id = $product->id;
      $payment->stripe_charge_id = $charge->id;
      $payment->paid_out = $payout;
      $payment->fees_collected = $amount - $payout;
      $payment->save(); 
    }

    public static function toStripeFormat(float $amount)
    {
        return $amount * 100;
    }
}