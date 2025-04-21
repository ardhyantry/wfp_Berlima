@extends('layouts.adminSB')

@section('title', 'Menu List')

@section('content')
<div class="container">
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
                        <a href="{{ route('menus.destroy', $m->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $m->id }}').submit();">
                            delete
                        </a>
                        <form id="delete-form-{{ $m->id }}" action="{{ route('menus.destroy', $m->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-center">Total Foods: {{ $listMenu->count() }}</td>
            </tr>
    </table>
</div>
@endsection