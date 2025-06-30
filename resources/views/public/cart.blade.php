@extends('layouts.custFeane')

@section('title', 'Keranjang Belanja')

{{-- Kita tidak menggunakan @yield('content') di sini karena kita ingin membuat struktur section sendiri --}}
{{-- Sebagai gantinya, kita akan menempatkan kode langsung di bawah header --}}

@section('content')
{{-- Kita bungkus semua konten dalam sebuah section baru agar konsisten dengan halaman lain --}}
<section class="cart_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Keranjang Belanja Anda
            </h2>
        </div>
        

        {{-- Notifikasi untuk pesan sukses atau error --}}
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
                            <th scope="col" class="text-center" style="width: 15%;">Jumlah</th>
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
                                </td>
                                <td class="text-center">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex justify-content-center">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm text-center" style="width: 70px;">
                                        <button type="submit" class="btn btn-sm btn-outline-primary ms-2">Update</button>
                                    </form>
                                </td>
                                <td class="text-end">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus item">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <a href="{{ route('public.menus.index') }}" class="btn btn-outline-primary"><i class="fa fa-arrow-left"></i> Lanjut Belanja</a>
                </div>
                <div class="col-md-6 text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <form action="{{ route('cart.clear') }}" method="POST" class="d-inline me-2">
                            @csrf
                            <button type="submit" class="btn btn-warning">Kosongkan Keranjang</button>
                        </form>
                        
                        {{-- TOMBOL CHECKOUT SUDAH FUNGSIONAL --}}
                        {{-- <form action="{{ route('checkout.process') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">Lanjutkan ke Checkout <i class="fa fa-arrow-right"></i></button>
                        </form> --}}
                    </div>
                    <h4 class="mt-3">Total Belanja: <span class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span></h4>
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