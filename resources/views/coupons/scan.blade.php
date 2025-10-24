<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Kupon — HARLAH RSUD JOMBANG KE 71</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/rs.png') }}">
    <meta content="#03A9F4" name="theme-color">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at center, #E1F5FE, #BBDEFB);
            color: #03396c;
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            */
        }

        /* ===== HEADER CERAH BIRU ===== */
        header {
            position: relative;
            width: 100%;
            padding: 25px 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(90deg, #0288D1, #03A9F4, #4FC3F7, #81D4FA);
            background-size: 300% 300%;
            animation: moveGradient 6s ease infinite;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
            border-bottom: 3px solid rgba(255, 255, 255, 0.6);
        }

        header h1 {
            font-size: 2.3rem;
            font-weight: 800;
            color: #fff;
            text-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
            letter-spacing: 2px;
            text-align: center;
            margin: 0;
            padding: 0;
        }
         header p {
             margin: 0;
            padding: 0;
         }

        .header-logos {
            position: absolute;
            right: 40px;
            top: 15px;
            display: flex;
            gap: 20px;
        }

        .header-logos img {
            height: 60px;
            width: auto;
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.9));
            transition: transform 0.3s ease, filter 0.3s ease;
        }

        .header-logos img:hover {
            transform: scale(1.1);
            filter: drop-shadow(0 0 15px rgba(255, 255, 255, 1));
        }


        .header-text {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        header .subtitle {
            font-size: 1.4rem;
            font-weight: 600;
            color: #e3f2fd;
            margin-top: 8px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
            animation: fadeIn 1.5s ease;
        }

        /* ===== FOOTER ===== */
        footer {
            width: 100%;
            background: linear-gradient(90deg, #0277BD, #4FC3F7, #03A9F4, #81D4FA);
            background-size: 300% 300%;
            animation: moveGradient 8s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            padding: 15px 0;
            flex-wrap: wrap;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.25);
            border-top: 3px solid rgba(255, 255, 255, 0.6);
        }

        footer img {
            height: 60px;
            width: auto;
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.9));
            transition: transform 0.3s ease, filter 0.3s ease;
        }

        footer img:hover {
            transform: scale(1.1);
            filter: drop-shadow(0 0 15px rgba(255, 255, 255, 1));
        }
    </style>
</head>

<body>

    <header>
        <div class="header-text">
            <h1 class="mb-1 pb-1">REGISTRASI KUPON</h1>
            <p class="subtitle ">DALAM RANGKA HARLAH RSUD JOMBANG KE 71</p>
        </div>
        <div class="header-logos">
            <img src="{{ asset('img/jbg.png') }}" alt="Logo A" class="header-logo">
            <img src="{{ asset('img/rs.png') }}" alt="Logo B">
        </div>
    </header>


    <div class="container">
        <div class="card shadow-sm">
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

                        <button style="background: linear-gradient(45deg, #0288D1, #26C6DA);"
                            class="btn  form-control text-light mt-3 fw-bold">REGISTRASI</button>
                    </form>

                    {{-- <hr> --}}

                    {{-- <h5>Atau Scan dengan Kamera</h5>
                        <div id="reader" style="width:100%;max-width:400px;margin:auto"></div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER DENGAN 5 GAMBAR -->
    <footer>
        <img src="{{ asset('img/f1.png') }}" alt="Logo 1">
        <img src="{{ asset('img/f2.png') }}" alt="Logo 2">
        <img src="{{ asset('img/f3.png') }}" alt="Logo 3">
        <img src="{{ asset('img/f4.png') }}" alt="Logo 4">
        <img src="{{ asset('img/f5.png') }}" alt="Logo 5">
    </footer>



</body>

</html>
