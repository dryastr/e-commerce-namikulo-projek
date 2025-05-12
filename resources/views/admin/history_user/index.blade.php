@extends('layouts.main')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Riwayat Transaksi</h4>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-xl">
                                <thead>
                                    <tr>
                                        <th>No Pesanan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Total Pembayaran</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                            <td>Rp {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                                            <td>{{ $order->payment->payment_method }}({{ $order->payment->payment_type }})
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal-{{ $order->id }}">Lihat Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($orders as $order)
        <div class="modal fade" id="detailModal-{{ $order->id }}" tabindex="-1"
            aria-labelledby="detailModalLabel-{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel-{{ $order->id }}">Detail Pesanan
                            #{{ $order->order_number }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Informasi Pesanan</h6>
                        <p>No Pesanan: {{ $order->order_number }}</p>
                        <p>Tanggal Pembelian: {{ $order->created_at->format('d-m-Y') }}</p>
                        <p>Total Pembayaran: Rp {{ number_format($order->total_amount, 2, ',', '.') }}</p>
                        <p>Metode Pembayaran: {{ $order->payment->payment_method }}({{ $order->payment->payment_type }})
                        </p>
                        <h6>Informasi Pelanggan</h6>
                        <p>Nama Pelanggan: {{ $order->user->name }}</p>
                        <p>Email Pelanggan: {{ $order->user->email }}</p>
                        <h6>Detail Produk</h6>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp {{ number_format($item->price, 2, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
