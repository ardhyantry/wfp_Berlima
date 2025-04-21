@extends('layouts.adminSB')

@section('title', 'Customer List')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table-auto w-full border-collapse border border-gray-200">
    <thead class="bg-gray-100">
        <tr>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Email</th>
            <th class="border px-4 py-2">Phone</th>
            <th class="border px-4 py-2">Username</th>
            <th class="border px-4 py-2">Created At</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $user)
        <tr>
            <td class="border px-4 py-2">{{ $user->name }}</td>
            <td class="border px-4 py-2">{{ $user->email }}</td>
            <td class="border px-4 py-2">{{ $user->phone_number }}</td>
            <td class="border px-4 py-2">{{ $user->username }}</td>
            <td class="border px-4 py-2">{{ $user->created_at }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('customers.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('customers.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
{{-- button add customer route to create --}}
<a href="{{ route('customers.create') }}" class="btn btn-primary">Add Customer</a>

@endsection