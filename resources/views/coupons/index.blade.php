@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
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
                <th>Aksi</th>
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
                            <span class="badge bg-danger">Sudah Dipakai</span>
                        @else
                            <span class="badge bg-success">Belum Dipakai</span>
                        @endif
                    </td>
                    <td>{{ $c->scanned_at ? $c->scanned_at->format('d-m-Y H:i') : '-' }}</td>
                    <td>
                        <a href="{{ route('coupons.show', $c->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                        <a href="{{ route('coupons.print', $c->id) }}" target="_blank"
                            class="btn btn-sm btn-secondary">Cetak</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $coupons->links() }}
@endsection
