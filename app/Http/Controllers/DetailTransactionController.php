<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DetailTransactionController extends Controller
{
    public function index()
    {
        $details = DetailTransaction::with(['transaction', 'menu'])->latest()->get();
        return view('detail-transactions.index', compact('details'));
    }

    public function create()
    {
        $transactions = Transaction::all();
        $menus = Menu::all();
        return view('detail-transactions.create', compact('transactions', 'menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transactions_id' => 'required|exists:transactions,id',
            'menus_id' => 'required|exists:menus,id',
            'portion_size' => 'required|string|max:50',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric',
            'notes' => 'nullable|string|max:255',
        ]);

        DetailTransaction::create($validated);

        return redirect()->route('web.detail-transactions.index')->with('success', 'Detail created successfully.');
    }

    public function show($id)
    {
        $detail = DetailTransaction::with(['transaction', 'menu'])->findOrFail($id);
        return view('detail-transactions.show', compact('detail'));
    }

    public function edit($id)
    {
        $detail = DetailTransaction::findOrFail($id);
        $transactions = Transaction::all();
        $menus = Menu::all();
        return view('detail-transactions.edit', compact('detail', 'transactions', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $detail = DetailTransaction::findOrFail($id);

        $validated = $request->validate([
            'transactions_id' => 'required|exists:transactions,id',
            'menus_id' => 'required|exists:menus,id',
            'portion_size' => 'required|string|max:50',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric',
            'notes' => 'nullable|string|max:255',
        ]);

        $detail->update($validated);

        return redirect()->route('web.detail-transactions.index')->with('success', 'Detail updated successfully.');
    }

    public function destroy($id)
    {
        $detail = DetailTransaction::findOrFail($id);
        $detail->delete();

        return redirect()->route('web.detail-transactions.index')->with('success', 'Detail deleted.');
    }
}
