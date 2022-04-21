<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>INOSOFT</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h1>APILKASI PENJUALAN</h1>
                </div>
            </div>
        </div>
        <div class="row text-center bg-light">
            <div class="col-lg-3 margin-tb border">
                <a href="{{ route('dashboard') }}" class="text-dark">
                    <h4>DASHBOARD</h4>
                </a>
            </div>
            <div class="col-lg-3 margin-tb border">
                <a href="{{ route('kendaraan.index') }}" class="text-dark">
                    <h4>KENDARAAN</h4>
                </a>
            </div>
            <div class="col-lg-3 margin-tb border">
                <a href="{{ route('mobil.index') }}" class="text-dark">
                    <h4>MOBIL</h4>
                </a>
            </div>
            <div class="col-lg-3 margin-tb border">
                <a href="{{ route('motor.index') }}" class="text-dark">
                    <h4>MOTOR</h4>
                </a>
            </div>
        </div>
        @yield('content')
    </div>

</body>

</html>