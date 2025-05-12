// View
@extends('layouts.main')

@section('title', 'Laporan Penjualan dan Keuangan')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Laporan Penjualan dan Keuangan</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Produk Terlaris</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach ($bestSellingProduct as $product => $sales)
                                <li>Produk: {{ $product }} - Jumlah Terjual: {{ $sales }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Total Pendapatan</h4>
                    </div>
                    <div class="card-body">
                        <p>Total Pendapatan: {{ $totalRevenue }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Metode Pembayaran Terpopuler</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach ($mostPopularPaymentMethod as $paymentMethod => $count)
                                <li>Metode Pembayaran: {{ $paymentMethod }} - Jumlah Penggunaan: {{ $count }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Jumlah Produk Terjual</h4>
                    </div>
                    <div class="card-body">
                        <p>Jumlah Produk Terjual: {{ $totalProductsSold }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Transaksi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xl">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Total Harga</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Detail Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactionList as $transaction)
                                            <tr>
                                                <td>{{ $transaction['date'] }}</td>
                                                <td>{{ $transaction['total_amount'] }}</td>
                                                <td>{{ $transaction['payment_method'] }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach ($transaction['items'] as $item)
                                                            <li>Produk: {{ $item['product_id'] }} - Jumlah:
                                                                {{ $item['quantity'] }}
                                                                -
                                                                Harga: {{ $item['price'] }}</li>
                                                        @endforeach
                                                    </ul>
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
    </div>
@endsection
