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
        $('#myModal').on('shown.bs.modal', function () {
          $('#myInput').trigger('focus')
        })
    </script>
</head>
<body>
    <div id="app">
        <div class="container-fluid">
            <div class="row justify-content-start">
                <div class="col-md-8 p-5">
                    <p>{{$detail_soal_now->desc_soal}}</p>
                    <form action="/simpan_jawaban" method="post">
                        @csrf
                        <input type="hidden" name="index" value="{{$index}}">
                        <input type="hidden" name="tr_data_code" value="{{$tr_data_code}}">
                        <input type="hidden" name="data_jawaban_code" value="{{$data_jawaban_code}}">
                        <input type="hidden" name="tr_soal_code" value="{{$tr_soal_code}}">

                        <div class="input-group mt-2">
                            <div class="input-group-prepend w-100">
                                <div class="input-group-text">
                                    <input type="radio" id="option_a" name="jawaban" value="option_a" {{$detail_soal_now->jawaban == 'option_a' ? "checked" : ''}}>
                                    <label for="option_a">{{$detail_soal_now->option_a}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend w-100">
                                <div class="input-group-text">
                                    <input type="radio" id="option_b" name="jawaban" value="option_b" {{$detail_soal_now->jawaban == 'option_b' ? "checked" : ''}}>
                                    <label for="option_b">{{$detail_soal_now->option_b}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend w-100">
                                <div class="input-group-text">
                                    <input type="radio" id="option_c" name="jawaban" value="option_c" {{$detail_soal_now->jawaban == 'option_c' ? "checked" : ''}}>
                                    <label for="option_c">{{$detail_soal_now->option_c}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend w-100">
                                <div class="input-group-text">
                                    <input type="radio" id="option_d" name="jawaban" value="option_d" {{$detail_soal_now->jawaban == 'option_d' ? "checked" : ''}}>
                                    <label for="option_d">{{$detail_soal_now->option_d}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend w-100">
                                <div class="input-group-text">
                                    <input type="radio" id="option_e" name="jawaban" value="option_e" {{$detail_soal_now->jawaban == 'option_e' ? "checked" : ''}}>
                                    <label for="option_e">{{$detail_soal_now->option_e}}</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">
                            {{$detail_soal->jml_soal == $index + 1 ? "Selesaikan Ujian" : "Soal Selanjutnya"}}
                        </button>
                    </form>
                </div>

                <div class="col-md-4 border p-3">
                    <div class="container">
                        <div class="row justify-content-start">
                            <p>
                                {{$detail_soal->tipe_soal}} - {{$detail_soal->nama_ujian}} <br>
                                Dosen: {{$detail_soal->nama_dosen}} <br>
                                Mata Kuliah: {{$detail_soal->nama_matkul}}
                            </p>
                            <h5>Nomor Soal</h5>

                            @foreach ($list_soal as $key => $soal)
                                <div class="col-md-1 border m-2 {{$soal->tr_soal_code == $tr_soal_code ? "bg-primary" : ($soal->terjawab ? "bg-warning" : '')}}">
                                    <a href="/kerjakan/{{$tr_data_code}}/{{$data_jawaban_code}}/{{$soal->tr_soal_code}}" class="text-black text-decoration-none">
                                        <div class="container">
                                            <div class="row pt-2">
                                                {{$key + 1}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>