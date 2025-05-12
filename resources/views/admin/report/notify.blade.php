@extends('layouts.main')

@section('title', 'Notifikasi')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Notifikasi</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul>
                    @foreach ($notifications as $notification)
                        @if (!$notification['read'])
                            <li>

                                {{ $notification['message'] }}

                                <a href="{{ route('notifyread') }}?read={{ $notification['id'] }}">Tandai sebagai dibaca</a>

                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
