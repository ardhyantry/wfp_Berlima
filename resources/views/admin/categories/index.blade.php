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
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listCategory as $category)
                <tr>
                    <td class="px-4 py-2 border text-center">{{ $category->id }}</td>
                    <td class="px-4 py-2 border">{{ $category->name }}</td>
                    <td class="px-4 py-2 border">
                        <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}"
                            style="width: 150px; height: 150px; object-fit: cover; border-radius: 6px;" />
                    </td>
                    <td class="px-4 py-2 border">{{ $category->created_at }}</td>
                    <td class="px-4 py-2 border">{{ $category->updated_at }}</td>
                    {{-- edit --}}
                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('categories.edit', $category->id) }}"
                            class="text-blue-500 hover:text-blue-700">Edit</a>
                    </td>
                    {{-- delete --}}
                    <td class="px-4 py-2 border text-center">
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mt-4">Add New Category</a>


@endsection