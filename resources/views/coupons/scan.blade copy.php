@extends('layouts.app')

@section('content')
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-12">
            <div class="card shadow-sm">
                 <div class="card-header  text-light text-center" style="background-color: #00365A">   <h4 class="">Scan atau Masukkan Kode Kupon</h4></div>

                <div class="card-body">
                    <div style="margin:2rem auto">


                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form id="couponForm" method="POST" action="{{ route('coupons.scan') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="code" class="form-label">Kode Kupon</label>
                                <input id="code" name="code" autofocus class="form-control" autocomplete="off"
                                    placeholder="Scan atau ketik kode kupon..." />
                            </div>

                            <button style="background-color: #00365A" class="btn  form-control text-light mt-3">REGISTRASI</button>
                        </form>

                        {{-- <hr> --}}

                        {{-- <h5>Atau Scan dengan Kamera</h5>
                        <div id="reader" style="width:100%;max-width:400px;margin:auto"></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Library HTML5 QR Code -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        // Fokus input & submit otomatis saat Enter ditekan
        document.getElementById('code').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });

        // Inisialisasi scanner kamera
        const qrReader = new Html5Qrcode("reader");

        function onScanSuccess(decodedText) {
            // isi otomatis input dan submit
            document.getElementById('code').value = decodedText;
            document.getElementById('couponForm').submit();
        }

        function onScanError(errorMessage) {
            // abaikan error kecil, tapi bisa di-log jika perlu
            // console.log(errorMessage);
        }

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                let cameraId = devices[0].id;
                qrReader.start(
                    cameraId, {
                        fps: 10, // frame per detik
                        qrbox: {
                            width: 250,
                            height: 250
                        } // area scan
                    },
                    onScanSuccess,
                    onScanError
                );
            }
        }).catch(err => {
            console.error("Gagal mengakses kamera:", err);
        });
    </script>
@endsection
