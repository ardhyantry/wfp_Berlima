@extends('layouts.adminSB')

@section('title', 'Customer List')

@section('content')
<table class="table-auto w-full border-collapse border border-gray-200">
    <thead class="bg-gray-100">
        <tr>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Email</th>
            <th class="border px-4 py-2">Phone</th>
            <th class="border px-4 py-2">Username</th>
            <th class="border px-4 py-2">Created At</th>
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
        </tr>
        @endforeach
    </tbody>
</table>

@endsection