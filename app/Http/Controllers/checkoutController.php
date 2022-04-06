<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Stripe\Exception\CardException;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Notifications\orderNotification;
use Illuminate\Support\Facades\Auth;

class checkoutController extends Controller
{
    public function store(Request $request, Cart $cart)
    {
        $order = Order::where('user_id',Auth::id())->orderBy('id', 'desc')->first();

        $qty = 0;
        foreach ($cart->books as $book) {
            $qty += $book->pivot->quantity;
        }
        try {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $order->total_price * 100,
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'description' => 'Order',
            'receipt_email' => $request->email,
        ]);

        $cart->delete($cart->id);

        $userNotify = User::find(Auth::id());

        $userNotify->notify(new orderNotification($order));
        }
        catch(CardException $e){
            return back()->withErrors('Error! ' . $e->getMessage());
        }
        return redirect()->route('order.confirm');
    }
}
