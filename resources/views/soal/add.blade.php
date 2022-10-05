@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Soal') }}</div>

                <div class="card-body">
                    
                    <form action="/soal/add" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="namaUjian">Nama Ujian</label>
                          <input type="text" class="form-control" id="namaUjian" aria-describedby="emailHelp" placeholder="Masukkan nama ujian..." name="nama_ujian">
                        </div>
                        <div class="form-group">
                          <label for="kodeMatkul">Matkul</label>
                          <select id="kodeMatkul" class="form-control" name="kode_matkul">
                            @foreach ($matkul as $item)
                                <option value="{{$item->kode_matkul}}">{{$item->nama_matkul}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="kodeDosen">Dosen</label>
                          <select id="kodeDosen" class="form-control" name="kode_dosen">
                            @foreach ($dosen as $item)
                                <option value="{{$item->kode_dosen}}">{{$item->nama_dosen}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="namaMatkul">Tahun Akademik</label>
                          <input type="text" class="form-control" id="tahun_akademik" aria-describedby="emailHelp" placeholder="Masukkan Kode Matkul..." name="tahun_akademik">
                        </div>
                        <div class="form-group">
                          <label for="namaMatkul">Semester</label>
                          <input type="text" class="form-control" id="semester" aria-describedby="emailHelp" placeholder="Masukkan Kode Matkul..." name="semester">
                        </div>
                        <div class="form-group">
                          <label for="namaMatkul">Kelas</label>
                          <input type="text" class="form-control" id="kelas" aria-describedby="emailHelp" placeholder="Masukkan Kode Matkul..." name="kelas">
                        </div>
                        <div class="form-group">
                          <label for="tipe_soal">Tipe Soal</label>
                          <select id="tipe_soal" class="form-control" name="tipe_soal">
                              <option value="UAS">UAS</option>
                              <option value="UTS">UTS</option>
                              <option value="QUIZ">QUIZ</option>
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
