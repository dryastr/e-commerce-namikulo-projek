@extends('layouts.main')

@section('title', 'Daftar Promo')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Daftar Promo</h4>
                    </div>
                </div>
                <div class="card-content">
                    <!-- Tabel Promo -->
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Persentase Diskon</th>
                                        <th>Periode Berlaku</th>
                                        <th>Promo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        @if ($product->promos->count() > 0)
                                            @foreach ($product->promos as $promo)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->price }}</td>
                                                    <td>{{ $promo->discount }}%</td>
                                                    <td>{{ $promo->start_date }} - {{ $promo->end_date }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#editPromoModal-{{ $promo->id }}">Edit</button>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('promo.destroy', $promo->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#addPromoModal-{{ $product->id }}">Tambah</button>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal Edit Promo -->
                    @foreach ($products as $product)
                        @if ($product->promos->count() > 0)
                            @foreach ($product->promos as $promo)
                                <div class="modal fade" id="editPromoModal-{{ $promo->id }}" tabindex="-1"
                                    aria-labelledby="editPromoModalLabel-{{ $promo->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editPromoModalLabel-{{ $promo->id }}">Ubah
                                                    Promo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('promo.update', $promo->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="discount" class="form-label">Persentase Diskon</label>
                                                        <input type="number" class="form-control" id="discount"
                                                            name="discount" value="{{ $promo->discount }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="start_date" class="form-label">Start Date</label>
                                                        <input type="date" class="form-control" id="start_date"
                                                            name="start_date" value="{{ $promo->start_date }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="end_date" class="form-label">End Date</label>
                                                        <input type="date" class="form-control" id="end_date"
                                                            name="end_date" value="{{ $promo->end_date }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach

                    <!-- Modal Tambah Promo -->
                    @foreach ($products as $product)
                        @if ($product->promos->count() == 0)
                            <div class="modal fade" id="addPromoModal-{{ $product->id }}" tabindex="-1"
                                aria-labelledby="addPromoModalLabel-{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addPromoModalLabel-{{ $product->id }}">Tambah
                                                Promo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('promo.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="mb-3">
                                                    <label for="discount" class="form-label">Persentase Diskon</label>
                                                    <input type="number" class="form-control" id="discount"
                                                        name="discount" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="start_date" class="form-label">Start Date</label>
                                                    <input type="date" class="form-control" id="start_date"
                                                        name="start_date" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="end_date" class="form-label">End Date</label>
                                                    <input type="date" class="form-control" id="end_date"
                                                        name="end_date" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
