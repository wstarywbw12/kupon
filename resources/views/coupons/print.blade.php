<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kupon {{ $coupon->code }}</title>
    <style>
        @page {
            size: 10cm 6cm;
            margin: 0;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .coupon {
            width: 10cm;
            height: 6cm;
            box-sizing: border-box;
            padding: 12px;
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: space-between;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
            background: linear-gradient(135deg, #ffffff, #f4f7fb);
        }

        .left {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .brand {
            font-weight: 700;
            font-size: 14px;
            color: #1f2937;
        }

        .title {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 0.6px;
        }

        .desc {
            font-size: 10px;
            color: #6b7280;
        }

        .code {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 4px;
            margin-top: 6px;
        }

        .barcode {
            width: 160px;
            /* adjust: will scale in print */
            height: auto;
        }
    </style>
</head>

<body>
    <div class="coupon">
        <div class="left">
            <div class="brand">Brand / Event Anda</div>
            <div class="title">Diskon Spesial</div>
            <div class="desc">Tunjukkan kupon ini saat registrasi. Satu kupon hanya berlaku satu kali.</div>
            <div class="code">{{ $coupon->code }}</div>
        </div>
        <div class="right">
            <img class="barcode" src="{{ asset('storage/' . $coupon->barcode_path) }}" alt="QR Code">
        </div>
    </div>
</body>

</html>
