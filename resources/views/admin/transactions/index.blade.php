@extends('layouts.adminSB')

@section('title', 'Transaction List')

@section('content')
<div class="container">
    <h2>Transaction List</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Subtotal</th>
                <th>Discount</th>
                <th>Total</th>
                <th>Order Type</th>
                <th>Payment Type</th>
                <th>Order Status</th>
                <th>User ID</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $tx)
            <tr>
                <td>{{ $tx->id }}</td>
                <td>{{ number_format($tx->subtotal) }}</td>
                <td>{{ number_format($tx->discount) }}</td>
                <td>{{ number_format($tx->total) }}</td>
                <td>{{ ucfirst($tx->order_type) }}</td>
                <td>{{ strtoupper($tx->payment_type) }}</td>
                <td>{{ $tx->status }}</td>
                <td>{{ $tx->users_id }}</td>
                <td>{{ $tx->created_at }}</td>
                <td>{{ $tx->updated_at }}</td>
                <td>
                    <a href="{{ route('admin.transactions.show', $tx->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('admin.transactions.edit', $tx->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.transactions.destroy', $tx->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="{{ route('admin.transactions.create') }}" class="btn btn-primary">Add Transaction</a>

@endsection