                        @extends('layouts.custFeane')

                        @section('title', 'Our Menu')

                        @section('content')
                            {{-- Notifikasi jika item berhasil ditambahkan ke keranjang --}}
                            {{-- Judul dan tombol Ingredients --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="flex-grow-1 text-center">Our Menu</h2>
    <button class="btn btn-outline-primary me-3" data-bs-toggle="modal" data-bs-target="#ingredientModal">
        Ingredients
    </button>
</div>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert" style="position: sticky; top: 80px; z-index: 1050; margin: 0 15px;">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- Modal Filter Ingredients --}}
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
                      <input class="form-check-input" type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}" id="ingredient{{ $ingredient->id }}">
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
                                                {{-- Pastikan path gambar Anda benar, contoh: 'storage/' . $menu->image_path --}}
                                                <img src="{{ asset('storage/' . $menu->image_path) }}" alt="{{ $menu->name }}"
                                                    class="img-fluid rounded-top-4">
                                            </div>
                                            <div class="detail-box p-3">
                                                <h5>{{ $menu->name }}</h5>
                                                <p>{{ $menu->description }}</p>
                                                <small class="text-muted d-block mb-2">{{ $menu->nutrition_fact ?? 'No nutrition info' }}</small>
                                                <div class="options d-flex justify-content-between align-items-center">
                                                    <h6 class="text-primary mb-0">Rp{{ number_format($menu->price, 0, ',', '.') }}</h6>
                                                    
                                                    {{-- INI BAGIAN YANG DIPERBARUI --}}
                                                    <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="fa fa-shopping-cart me-1"></i> Tambah
                                                        </button>
                                                    </form>
                                                    {{-- AKHIR BAGIAN YANG DIPERBARUI --}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endsection

                        @push('scripts')
                            {{-- Skrip untuk Isotope filtering --}}
                            <script>
                                $(document).ready(function () {
                                    var $grid = $('.grid').isotope({
                                        itemSelector: '.all', // Ubah selector ke .all agar semua item terdeteksi
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