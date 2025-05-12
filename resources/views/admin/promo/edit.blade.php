// View promo.edit
@extends('layouts.main')

@section('title', 'Edit Promo')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Edit Promo</h4>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('update-promo', $promo->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="id" name="id" value="{{ $promo->id }}">
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="number" class="form-control" id="discount" name="discount"
                                    value="{{ $promo->discount }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ $promo->start_date }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="{{ $promo->end_date }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
