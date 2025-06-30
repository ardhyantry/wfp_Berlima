<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $cart = session('cart');
        if (!$cart || count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('public.checkout', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'order_type' => 'required|in:dine_in,take_away',
            'payment_type' => 'required|in:QRIS,credit_card,debit_card,e_wallet',
        ]);

        $cart = session('cart');
        if (!$cart || count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();
        try {
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            $discount = 0; // bisa kamu kembangkan
            $total = $subtotal - $discount;

            $transaction = Transaction::create([
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'order_type' => $request->order_type,
                'payment_type' => $request->payment_type,
                'status' => 'pending',
                'users_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($cart as $item) {
                Order::create([
                    'transactions_id' => $transaction->id,
                    'menus_id' => $item['id'],
                    'portion_size' => $item['portion_size'] ?? 'medium',
                    'quantity' => $item['quantity'],
                    'total' => $item['price'] * $item['quantity'],
                    'notes' => $item['notes'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            session()->forget('cart');
            return redirect()->route('cart.index')->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('cart.index')->with('error', 'Gagal proses checkout: ' . $e->getMessage());
        }
    }
}
