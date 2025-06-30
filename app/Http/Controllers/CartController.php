<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan halaman keranjang belanja
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('public.cart.cart', compact('cart', 'total'));
    }

    // Menambah item ke keranjang
    public function add(Menu $menu)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$menu->id])) {
            // jika item sudah ada, tambah quantity
            $cart[$menu->id]['quantity']++;
        } else {
            // jika item baru, tambahkan ke keranjang
            $cart[$menu->id] = [
                "name" => $menu->name,
                "quantity" => 1,
                "price" => $menu->price,
                "image_path" => $menu->image_path
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    // Memperbarui quantity item
    public function update(Request $request, Menu $menu)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity');

        if (isset($cart[$menu->id]) && $quantity > 0) {
            $cart[$menu->id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
        }

        return redirect()->route('cart.index')->with('error', 'Gagal memperbarui keranjang.');
    }

    // Menghapus item dari keranjang
    public function remove(Menu $menu)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$menu->id])) {
            unset($cart[$menu->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    // Mengosongkan keranjang
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan.');
    }
}