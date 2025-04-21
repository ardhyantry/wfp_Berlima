@extends('layouts.adminSB')

@section('title', 'Menu List')

@section('content')
    <div class="container">
        @if (session('successDel'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif
        @if (session('successUp'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif
        <h1>Menu List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Nutrition Facts</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listMenu as $m)
                    <tr>
                        <td>
                            <a href="{{ route('menus.show', $m->id) }}">
                                view details
                            </a>
                        </td>
                        <td>{{ $m->id }}</td>
                        <td>{{ $m->name }}</td>
                        <td>{{ $m->nutrition_facts }}</td>
                        <td>{{ $m->description }}</td>
                        <td>{{ $m->price }}</td>
                        <td>{{ $m->category->name }}</td>
                        <td>
                            <a href="{{ route('menus.edit', $m->id) }}">
                                edit
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $m->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-center">Total Foods: {{ $listMenu->count() }}</td>
                </tr>
        </table>
        {{-- button create menu route --}}
        <a href="{{ route('menus.create') }}" class="btn btn-primary">Create Menu</a>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $m->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $m->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel{{ $m->id }}">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin menghapus menu <strong>{{ $m->name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                    <form action="{{ route('menus.destroy', $m->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection