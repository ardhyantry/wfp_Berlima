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
    @foreach ($listMenu as $categoryName => $menus)
        @foreach ($menus as $menu)
            <div class="col-sm-6 col-lg-4 all {{ strtolower(str_replace(' ', '-', $categoryName)) }}">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
    @section('buttonViewMore')
        <div class="btn-box">
            <a href="{{ route('public.menus.index') }}">
                View More
            </a>
        </div>
    @endsection
@endsection


@push('scripts')
    <script>
        $(document).ready(function () {
            var $grid = $('.grid').isotope({
                itemSelector: '.col-sm-6',
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