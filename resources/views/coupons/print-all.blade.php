<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Semua Kupon</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        @page {
            size: 21cm 33cm;
            /* Kertas F4 */
            margin: 0.5cm;
        }

        body {
            background-color: #fff;
            font-family: Arial, Helvetica, sans-serif;
            -webkit-print-color-adjust: exact;
        }

        /* Kupon dengan background image */
        .coupon {
            width: 15cm;
            height: 5cm;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 14px;
            border-radius: 12px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
            background: url("{{ asset('img/bg.png') }}") no-repeat center center;
            background-size: cover;
            /* gambar menyesuaikan area */
            margin-bottom: 0.5cm;
            /* lebih rapat agar muat 5 baris */
            page-break-inside: avoid;
            position: relative;
            color: #111827;
        }

        .left {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 4px;
            z-index: 2;
            /* agar teks muncul di atas background */
        }

        .brand {
            font-weight: 700;
            font-size: 12px;
            color: #111827;
        }

        .title {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 2px;
        }

        .desc {
            font-size: 9px;
            color: #374151;
            line-height: 1.2;
            max-width: 8cm;
        }

        .code {
            font-size: 20px;
            font-weight: 800;
        }

        .nomor {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            margin-top: 120px;
            margin-right: 80px;
        }

        .qr {
            width: 120px;
            height: 120px;
            object-fit: contain;
            z-index: 2;
        }

        .page-break {
            page-break-after: always;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .col-print-12 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body class="container-fluid py-3">
    <div class="row g-3 justify-content-center">
        @foreach ($coupons as $index => $coupon)
            <div class="col-12 d-flex justify-content-center">
                <div class="coupon">
                    <div class="right text-center">
                        <img  src="{{ asset('storage/' . $coupon->barcode_path) }}" class="qr mr-5"
                            alt="QR {{ $coupon->code }}">
                    </div>
                    <div class="">
                        {{-- <div class="brand">RSUD JOMBANG</div>
                                <div class="title">Kupon Undian</div>
                                <div class="desc">Scan QR Code untuk registrasi. Satu kupon hanya berlaku satu kali.</div>
                                 --}}

                        <div  class="nomor ">{{ $coupon->code }}</div>

                    </div>

                </div>
            </div>

            {{-- Setiap 10 kupon, buat page break --}}
            @if (($index + 1) % 10 == 0)
                <div class="page-break"></div>
            @endif
        @endforeach
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
