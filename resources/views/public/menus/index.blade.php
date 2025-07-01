@extends('layouts.custFeane')

@section('title', 'Our Menu')


@section('menu_category_section')
    <section class="food_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Our Menu</h2>
            </div>

            <div class="filters-content">
                <ul class="filters_menu list-inline text-center mb-4">
                    <li class="list-inline-item btn btn-dark active" data-filter="*">All</li>
                    <li class="list-inline-item btn btn-outline-dark" data-filter=".appetizer">Appetizer</li>
                    <li class="list-inline-item btn btn-outline-dark" data-filter=".main-course">Main Course</li>
                    <li class="list-inline-item btn btn-outline-dark" data-filter=".snacks">Snacks</li>
                    <li class="list-inline-item btn btn-outline-dark" data-filter=".dessert">Dessert</li>
                    <li class="list-inline-item btn btn-outline-dark" data-filter=".coffee">Coffee</li>
                    <li class="list-inline-item btn btn-outline-dark" data-filter=".non-coffee">Non-Coffee</li>
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="flex-grow-1 text-center">Our Menu</h2>
        <button class="btn btn-outline-primary me-3" data-bs-toggle="modal" data-bs-target="#ingredientModal">
            Ingredients
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert"
            style="position: sticky; top: 80px; z-index: 1050; margin: 0 15px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="modal fade" id="ingredientModal" tabindex="-1" aria-labelledby="ingredientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ingredientModalLabel">Pilih Bahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="GET" action="{{ route('menu.filter') }}">
                    <div class="modal-body">
                        @foreach($ingredients as $ingredient)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="ingredients[]"
                                    value="{{ $ingredient->id }}" id="ingredient{{ $ingredient->id }}">
                                <label class="form-check-label" for="ingredient{{ $ingredient->id }}">
                                    {{ $ingredient->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($listMenu as $menu)
        <div class="col-sm-6 col-lg-4 all {{ strtolower(str_replace(' ', '-', $menu->category->name)) }}">
            <div class="box shadow rounded-4 mb-4">
                <div>
                    <div class="img-box">
                        <img src="{{ asset('storage/' . $menu->image_path) }}" alt="{{ $menu->name }}"
                            class="img-fluid rounded-top-4">
                    </div>
                    <div class="detail-box p-3">
                        <h5>{{ $menu->name }}</h5>
                        <p>{{ $menu->description }}</p>
                        <small class="text-muted d-block mb-2">{{ $menu->nutrition_fact ?? 'No nutrition info' }}</small>
                        <div class="options d-flex justify-content-between align-items-center">
                            <h6 class="text-primary mb-0">Rp{{ number_format($menu->price, 0, ',', '.') }}</h6>

                            <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa fa-shopping-cart me-1"></i> Tambah
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            var $grid = $('.grid').isotope({
                itemSelector: '.all',
                layoutMode: 'fitRows'
            });

            $('.filters_menu li').on('click', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({ filter: filterValue });

                $('.filters_menu li').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endpush