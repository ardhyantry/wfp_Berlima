@extends('layouts.custFeane')

@section('title', 'Keranjang Belanja')

@section('cart')
    <section class="cart_section layout_padding" style="margin-top: 100px;">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Keranjang Belanja Anda</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(isset($cart) && count($cart) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Produk</th>
                                <th scope="col"></th>
                                <th scope="col" class="text-center">Harga</th>
                                <th scope="col" class="text-center" style="width: 20%;">Jumlah & Ukuran</th>
                                <th scope="col" class="text-end">Subtotal</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $item['image_path']) }}" width="100" class="rounded" alt="{{ $item['name'] }}">
                                    </td>
                                    <td>
                                        <strong>{{ $item['name'] }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            Ukuran: {{ ucfirst($item['portion_size'] ?? 'normal') }}
                                        </small>
                                    </td>
                                    <td class="text-center">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex flex-column align-items-center">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm text-center mb-2" style="width: 70px;">

                                            <select name="portion_size" class="form-select form-select-sm mb-2" style="width: 100px;">
                                                <option value="small" {{ ($item['portion_size'] ?? 'normal') === 'small' ? 'selected' : '' }}>Small</option>
                                                <option value="normal" {{ ($item['portion_size'] ?? 'normal') === 'normal' ? 'selected' : '' }}>Normal</option>
                                                <option value="large" {{ ($item['portion_size'] ?? 'normal') === 'large' ? 'selected' : '' }}>Large</option>
                                            </select>

                                            <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                        </form>
                                    </td>
                                    <td class="text-end">
                                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus item">
                                                <i class="fa fa-trash"></i>
                                            </button>   
                                                <button type="button" class="btn btn-sm btn-outline-info mt-2" data-bs-toggle="modal" data-bs-target="#ingredientsModal{{ $item['id'] }}">
                                                 Ingredients
                                                </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($cart as $id => $item)
<!-- Modal Ingredients -->
<div class="modal fade" id="ingredientsModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="ingredientsModalLabel{{ $item['id'] }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ingredientsModalLabel{{ $item['id'] }}">Bahan - {{ $item['name'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form>
                    @if(isset($menus[$item['id']]))
                        @foreach($menus[$item['id']]->ingredients as $ingredient)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $ingredient->id }}" id="ingredient{{ $item['id'] }}-{{ $ingredient->id }}" checked name="ingredients[]">

                                <label class="form-check-label" for="ingredient{{ $item['id'] }}-{{ $ingredient->id }}">
                                    {{ $ingredient->name }}
                                </label>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">Tidak ada data bahan tersedia.</p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="{{ route('public.menus.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Lanjut Belanja
                        </a>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline me-2">
                                @csrf
                                <button type="submit" class="btn btn-warning">Kosongkan Keranjang</button>
                            </form>

                            <a href="{{ route('checkout.show') }}" class="btn btn-success">Lanjutkan ke Checkout <i class="fa fa-arrow-right"></i></a>
                        </div>
                        <h4 class="mt-3">Total Belanja: 
                            <span class="text-primary">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </h4>
                    </div>
                </div>

            @else
                <div class="alert alert-info mt-4 text-center">
                    <h4>Keranjang belanja Anda masih kosong.</h4>
                    <a href="{{ route('public.menus.index') }}" class="btn btn-primary mt-3">Lihat Menu Kami</a>
                </div>
            @endif
        </div>
    </section>
@endsection
