@extends('layouts.custFeane')

@section('title', 'Menu List')
@section('content')
    @foreach($menus as $menu)
        <div class="col-sm-6 col-lg-4 all">
            <div class="box shadow-sm rounded-4 mb-4">
                <div>
                    <div class="img-box">
                        <img src="{{ asset('images/' . $menu->image_path) }}" alt="{{ $menu->name }}"
                            class="img-fluid rounded-top-4">
                    </div>
                    <div class="detail-box p-3">
                        <h5>{{ $menu->name }}</h5>
                        <p>{{ $menu->description }}</p>
                        <small class="text-muted d-block mb-2">{{ $menu->nutrition_fact }}</small>
                        <div class="options d-flex justify-content-between align-items-center">
                            <h6 class="text-primary mb-0">Rp{{ number_format($menu->price, 0, ',', '.') }}</h6>
                            <a href="#" class="btn btn-sm btn-outline-primary">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection