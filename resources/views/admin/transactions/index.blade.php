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
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $tx->id }}">
                                Delete
                            </button>
                    </tr>

                    <div class="modal fade" id="deleteModal{{ $tx->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel{{ $tx->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $tx->id }}">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah kamu yakin ingin menghapus menu <strong>{{ $tx->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                    <form action="{{ route('admin.transactions.destroy', $tx->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('admin.transactions.create') }}" class="btn btn-primary">Add Transaction</a>


@endsection