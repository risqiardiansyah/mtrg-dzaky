<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
</head>

<body>
    <div id="app">
        <div class="container-fluid">
            <div class="row">
                <h2 class="text-center mt-5">Hasil Ujian</h2>
                <div class="col-md-12 p-5 d-flex justify-content-center">
                    <div class="card m-3">
                        <div class="card-body text-green text-center">
                            <h3 class="card-title mb-2">Benar</h3>
                            <h4 class="card-text">{{$benar}}</h4>
                        </div>
                    </div>
                    <div class="card m-3">
                        <div class="card-body text-danger text-center">
                            <h3 class="card-title mb-2">Salah</h3>
                            <h4 class="card-text">{{$salah}}</h4>
                        </div>
                    </div>
                    <div class="card m-3">
                        <div class="card-body text-warning text-center">
                            <h3 class="card-title mb-2">Tidak Dijawab</h3>
                            <h4 class="card-text">{{$tidak_dijawab}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <div class="card" style="width: 18rem">
                    <div class="card-body text-success text-center">
                        <h3 class="card-title mb-2">Nilai</h3>
                        <h4 class="card-text">{{$data_jawaban->nilai}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center mt-5">
                <a href="/soal" class="btn btn-primary btn-large">Kembali Ke List Soal</a>
            </div>
        </div>
    </div>
</body>

</html>