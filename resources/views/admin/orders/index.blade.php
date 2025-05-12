@extends('layouts.main')

@section('title', 'Daftar Pemesanan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Daftar Pemesanan</h4>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-xl">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Order Number</th>
                                        <th>Total Amount</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->total_amount }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                @if ($order->status == 'pending')
                                                    <div class="badge bg-warning">
                                                        <p class="mb-0">Pending</p>
                                                    </div>
                                                @elseif($order->status == 'processing')
                                                    <div class="badge bg-info">
                                                        <p class="mb-0">Processing</p>
                                                    </div>
                                                @elseif($order->status == 'completed')
                                                    <div class="badge bg-success">
                                                        <p class="mb-0">Completed</p>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-nowrap">
                                                <div class="dropdown dropup">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton-{{ $order->id }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton-{{ $order->id }}">
                                                        {{-- <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('orders.show', $order->id) }}">Detail</a>
                                                        </li> --}}
                                                        <li>
                                                            <form action="{{ route('orders.confirm-payment', $order->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="completed">
                                                                <button type="submit" class="dropdown-item">Konfirmasi
                                                                    Pembayaran</button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('orders.download-invoice', $order->id) }}">Download
                                                                Invoice</a>
                                                        </li>
                                                    </ul>
                                                </div>
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
@endsection
