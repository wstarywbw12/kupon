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
            background: url("{{ asset('img/bg2.jpeg') }}") no-repeat center center;
            background-size: cover;
            margin-bottom: 0.5cm;
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

        /* Bagian kanan (QR dan Nomor) */
        .right {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .qr-wrapper {
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 118px;
            height: 130px;
            border-radius: 9px;
            margin-top: 1px;
            border: 2px solid black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .qr {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .nomor {
            font-size: 18px;
            font-weight: 800;
            color: black;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 118px;
            height: 28px;
            border-radius: 9px;
            text-align: center;
            margin: 0;
            border: 2px solid black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }


        /* .page-break {
            page-break-after: always;
        } */

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
                    <div class="left">
                        {{-- Tambahkan jika ingin teks lain di sisi kiri --}}
                        {{-- <div class="brand">RSUD JOMBANG</div>
                        <div class="title">Kupon Undian</div>
                        <div class="desc">Scan QR Code untuk registrasi. Satu kupon hanya berlaku satu kali.</div> --}}
                    </div>

                    <div class="right">
                        <div class="qr-wrapper">
                            <img src="{{ asset('storage/' . $coupon->barcode_path) }}" class="qr"
                                alt="QR {{ $coupon->code }}">
                        </div>
                        <div class="car">
                            <div class="nomor">{{ $coupon->code }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
