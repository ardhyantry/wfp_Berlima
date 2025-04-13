@extends('layouts.SB')

@section('title', 'Food List')

@section('content')
<div class="container">
    <h1>Food List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Nutrition Facts</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foods as $food)
                <tr>
                    <td>{{ $food->id }}</td>
                    <td>{{ $food->name }}</td>
                    <td>{{ $food->nutrition_facts }}</td>
                    <td>{{ $food->description }}</td>
                    <td>{{ $food->price }}</td>
                    <td>{{ $food->category_name }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-center">Total Foods: {{ $foods->count() }}</td>
            </tr>
    </table>
</div>
@endsection