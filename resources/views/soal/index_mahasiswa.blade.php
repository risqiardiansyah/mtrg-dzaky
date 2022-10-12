@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-1"></div>
        <div class="col-md-11 justify-content-start">
            <div class="container">
                <div class="row justify-content-start">
                    <h1>List Ujian</h1>
                    @foreach ($data as $item)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{$item->tipe_soal}}</h5>
                                    <p class="card-text">
                                        {{$item->nama_ujian}} <br>
                                        Matkul : {{$item->nama_matkul}} <br>
                                        Dosen : {{$item->nama_dosen}} <br>
                                        Tahun : {{$item->tahun_akademik}} <br>
                                        Semester : {{$item->semester}} <br>
                                        Kelas : {{$item->kelas}} <br>
                                        Jml Soal : {{$item->jml_soal}} <br>

                                        @if ($item->status_pengerjaan == 'finish')
                                            <b>Nilai : {{$item->nilai}}</b>
                                        @endif
                                    </p>
                                    @if ($item->status_pengerjaan == '')
                                        <form action="/kerjakan" method="POST">
                                            @csrf
                                            <input type="hidden" name="tr_data_code" value="{{$item->tr_data_code}}">

                                            <button type="submit" class="btn btn-primary">Kerjakan</button>
                                        </form>
                                    @elseif($item->status_pengerjaan == 'progress')
                                        <a href="/kerjakan/{{$item->tr_data_code}}/{{$item->data_jawaban_code}}/{{$item->tr_soal_code}}" class="btn btn-success">
                                            Lanjut Mengerjakan
                                        </a>
                                    @else
                                        <button class="btn btn-primary" disabled>Telah Dikerjakan</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
