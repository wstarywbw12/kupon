<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Semua Kupon</title>
    <style>
        @page {
            size: 21cm 33cm;
            /* F4 */
            margin: 0.5cm;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #fff;
        }

        .sheet {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* 2 kolom per baris */
            gap: 0.7cm;
        }

        .coupon {
            width: 10cm;
            height: 6cm;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 14px;
            border-radius: 12px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #ffffff, #f7f8fb);
            page-break-inside: avoid;
        }

        .left {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 4px;
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
            color: #6b7280;
            line-height: 1.2;
            max-width: 8cm;
        }

        .code {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 2px;
            margin-top: 6px;
        }

        .qr {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="sheet">
        @foreach ($coupons as $coupon)
            <div class="coupon">
                <div class="left">
                    <div class="brand">Brand / Event Anda</div>
                    <div class="title">Diskon Spesial</div>
                    <div class="desc">Tunjukkan kupon ini saat registrasi. Satu kupon hanya berlaku satu kali.
                    </div>
                    <div class="code">{{ $coupon->code }}</div>
                </div>
                <div class="right">
                    <img src="{{ asset('storage/' . $coupon->barcode_path) }}" class="qr"
                        alt="QR {{ $coupon->code }}">
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
