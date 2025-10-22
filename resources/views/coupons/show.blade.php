@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body text-center">
            <h3>Kode Kupon: {{ $coupon->code }}</h3>
            <p>Status:
                @if ($coupon->used)
                    <span class="badge bg-danger">Sudah Digunakan</span>
                @else
                    <span class="badge bg-success">Belum Digunakan</span>
                @endif
            </p>
            @if ($coupon->barcode_path)
                <img src="{{ asset('storage/' . $coupon->barcode_path) }}" alt="QR Code" style="max-width:200px;">
            @endif

            <div class="mt-3">
                <a href="{{ route('coupons.print', $coupon->id) }}" class="btn btn-primary" target="_blank">Cetak Kupon</a>
            </div>
        </div>
    </div>
@endsection
