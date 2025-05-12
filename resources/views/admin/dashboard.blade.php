@extends('layouts.main')

@section('title', 'Dashboard Admin')

@section('content')
    Selamat datang {{ auth()->user()->name }}!
@endsection
