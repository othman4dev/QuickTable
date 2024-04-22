<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StripeController extends Controller
{
    public static function index() {
        return redirect('/');
    }
    public static function checkout(Request $request) {
        $item = DB::table('menu')->where('id', $request->id)->first();
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $request->price * 100,
                ],
                'quantity' => $request->quantity,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success', ['id' => $request->id, 'quantity' => $request->quantity]),
            'cancel_url' => url('/')
        ]);
        return redirect()->away($session->url);
    }
    public static function success(Request $request) {
        $id = $request->query('id');
        $quantity = $request->query('quantity');
        $item = DB::table('menu')->where('id', $id)->first();
        $token = rand(10000000, 99999999);
        DB::table('reservation')->insert([
            'user_id' => session('user')->id,
            'item_id' => $id,
            'business_id' => $item->business_id,
            'quantity' => $quantity,
            'type' => 'stripe',
            'token' => $token,
            'status' => 1,
            'expires_at' => now()->addDays(7),
            'created_at' => now()
        ]);
        return redirect('/myReservations');
    }
}
