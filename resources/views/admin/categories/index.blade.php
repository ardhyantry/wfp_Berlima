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
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $category->id }}">
                            Delete
                        </button>
                </tr>

                {{-- modals --}}
                <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1"
                    aria-labelledby="deleteModalLabel{{ $category->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteModalLabel{{ $category->id }}">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                Apakah kamu yakin ingin menghapus Category <strong>{{ $category->name }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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

    <a href="{{ route('categories.create') }}" class="btn btn-primary mt-4">Add New Category</a>



@endsection