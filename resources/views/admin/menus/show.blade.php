@extends('layouts.adminSB')


@section('title', 'Menu Show')

@section('content')
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        show image
    </button> --}}
    <a class="btn btn-primary" href="{{url()->previous()}}"> Go Back </a>
    <div class="container">
        <h1>{{ $menu->name }}</h1>
        <h2>{{ $menu->nutrition_fact }}</h2>
        <h3>{{ $menu->category->name }}</h3>
        <h4>{{ $menu->description }}</h4>
        <h5>{{ $menu->price }}</h5>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection