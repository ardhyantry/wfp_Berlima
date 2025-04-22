<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Menu;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all orders from the database
        $orders = Order::all();

        // Return a view with the orders data
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transactions = Transaction::all();
        $menus = Menu::all();

        return view('admin.orders.create', compact('transactions', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'transactions_id' => 'required|exists:transactions,id',
            'menus_id'        => 'required|exists:menus,id',
            'portion_size'    => 'required|string',
            'quantity'        => 'required|integer|min:1',
            'total'           => 'required|numeric|min:0',
            'notes'           => 'nullable|string',
        ]);

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $transactions = Transaction::all();
        $menus = Menu::all();

        return view('admin.orders.edit', compact('order', 'transactions', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'transactions_id' => 'required|exists:transactions,id',
            'menus_id'        => 'required|exists:menus,id',
            'portion_size'    => 'required|string',
            'quantity'        => 'required|integer|min:1',
            'total'           => 'required|numeric|min:0',
            'notes'           => 'nullable|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
