<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('public.cart', compact('cart', 'total'));
    }

    public function add(Menu $menu)
    {
        $cart = session()->get('cart', []);

        $portionSize = 'normal';
        $adjustedPrice = $this->adjustPrice($menu->price, $portionSize);

        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity']++;
        } else {
            $cart[$menu->id] = [
                "id" => $menu->id,
                "name" => $menu->name,
                "quantity" => 1,
                "price" => $adjustedPrice,
                "image_path" => $menu->image_path,
                "portion_size" => $portionSize
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, Menu $menu)
{
    $cart = session()->get('cart', []);
    $quantity = $request->input('quantity');
    $portionSize = $request->input('portion_size', 'normal');

    if (isset($cart[$menu->id]) && $quantity > 0) {
        $adjustedPrice = $this->adjustPrice($menu->price, $portionSize);

        $cart[$menu->id]['quantity'] = $quantity;
        $cart[$menu->id]['portion_size'] = $portionSize;
        $cart[$menu->id]['price'] = $adjustedPrice;
        $cart[$menu->id]['id'] = $menu->id;

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    return redirect()->route('cart.index')->with('error', 'Gagal memperbarui keranjang.');
}


    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan.');
    }

    private function adjustPrice($basePrice, $portionSize)
    {
        return match ($portionSize) {
            'small' => $basePrice - 2000,
            'large' => $basePrice + 3000,
            default => $basePrice,
        };
    }

}
