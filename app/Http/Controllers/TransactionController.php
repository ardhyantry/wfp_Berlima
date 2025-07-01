<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.transactions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subtotal' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'total' => 'required|numeric',
            'order_type' => 'required|in:dine_in,take_away',
            'payment_type' => 'required|in:QRIS,credit_card,debit_card,e_wallet',
            'status' => 'required|in:pending,processing,cancelled,ready',
            'users_id' => 'required|exists:users,id',
        ]);

        Transaction::create($validated);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'orders.menu'])->findOrFail($id);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $users = User::all();
        return view('admin.transactions.edit', compact('transaction', 'users'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $validated = $request->validate([
            'subtotal' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'total' => 'required|numeric',
            'order_type' => 'required|in:dine_in,take_away',
            'payment_type' => 'required|in:QRIS,credit_card,debit_card,e_wallet',
            'status' => 'required|in:pending,processing,cancelled,ready',
            'users_id' => 'required|exists:users,id',
        ]);

        $transaction->update($validated);

        if ($validated['status'] === 'ready') {
            return redirect()->route('public.menus.index')
                ->with('success', 'Transaction updated successfully.')
                ->with('showReadyModal', true)
                ->with('readyTransactionId', $transaction->id)
                ->with('order_ready', 'Pesanan Anda (ID #' . $transaction->id . ') sudah siap diambil.');
        }

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction deleted.');
    }
    public function updateStatusAjax(Request $request, $id)
{
    $transaction = Transaction::findOrFail($id);

    $validated = $request->validate([
        'status' => 'required|in:pending,processing,cancelled,ready',
    ]);

    $transaction->status = $validated['status'];
    $transaction->save();
    if ($transaction->status === 'ready') {
        session()->flash('order_ready', 'Pesanan dengan ID #' . $transaction->id . ' sudah siap diambil.');
    }

    return response()->json([
        'message' => 'Status updated successfully.',
        'is_ready' => $transaction->status === 'ready',
        'transaction_id' => $transaction->id,
    ]);
}
    public function checkOrderStatus()
    {
        $userId = Auth::id();

        $readyTransaction = Transaction::where('users_id', $userId)
            ->where('status', 'ready')
            ->latest()
            ->first();

        if ($readyTransaction) {
            return response()->json([
                'status' => 'ready',
                'message' => 'Pesanan Anda dengan sudah siap diambil!'
            ]);
        }

        return response()->json(['status' => 'none']);
    }

}