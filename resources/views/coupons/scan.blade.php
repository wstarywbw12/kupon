@extends('layouts.app')
@section('content')
<div style="max-width:600px;margin:2rem auto">
    @if(session('error')) <div class="alert alert-danger">{{session('error')}}</div> @endif
    @if(session('success')) <div class="alert alert-success">{{session('success')}}</div> @endif

    <form method="POST" action="{{ route('coupons.scan') }}">
        @csrf
        <label for="code">Scan atau masukkan kode kupon (scanner biasanya input + Enter)</label>
        <input id="code" name="code" autofocus class="form-control" autocomplete="off" />
        <button class="btn btn-primary mt-2">Daftarkan</button>
    </form>
</div>
<script>
    // fokus dan otomatis submit saat Enter (scanner akan mengirim Enter)
    document.getElementById('code').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.form.submit();
        }
    });
</script>
@endsection
