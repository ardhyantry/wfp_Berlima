@extends('layouts.adminSB')
@section('title', 'Category List')

@section('content')
<table class="table-auto w-full border border-gray-300 mt-4">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Name</th>
            <th class="px-4 py-2 border">Image</th>
            <th class="px-4 py-2 border">Created At</th>
            <th class="px-4 py-2 border">Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listCategory as $category)
        <tr>
            <td class="px-4 py-2 border text-center">{{ $category->id }}</td>
            <td class="px-4 py-2 border">{{ $category->name }}</td>
            <td class="px-4 py-2 border">
                <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="w-16 h-16 object-cover rounded">
            </td>
            <td class="px-4 py-2 border">{{ $category->created_at }}</td>
            <td class="px-4 py-2 border">{{ $category->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection