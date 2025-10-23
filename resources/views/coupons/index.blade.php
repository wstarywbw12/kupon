@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center my-3">
        <h4>Daftar Kupon</h4>
        <a href="{{ url('/scan') }}" class="btn btn-success">Scan Kupon</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Barcode</th>
                <th>Status</th>
                <th>Terdaftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coupons as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td><strong>{{ $c->code }}</strong></td>
                    <td>
                        @if ($c->barcode_path)
                            <img src="{{ asset('storage/' . $c->barcode_path) }}" alt="qr" width="100">
                        @endif
                    </td>

                    <td>
                        @if ($c->used)
                            <span class="badge bg-danger">Sudah Registrasi</span>
                        @else
                            <span class="badge bg-success">Belum Registrasi</span>
                        @endif
                    </td>
                    <td>{{ $c->scanned_at ? $c->scanned_at->format('d-m-Y H:i') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $coupons->links() }}
@endsection
