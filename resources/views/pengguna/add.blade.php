@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah ').$role }}</div>

                <div class="card-body">
                    
                    <form action="/pengguna/add" method="post">
                        @csrf
                        <input type="hidden" name="role" value="{{$role}}">
                        <div class="form-group">
                          <label for="kodeMatkul">Nama</label>
                          <input type="text" class="form-control" id="kodeMatkul" placeholder="Masukkan Nama..." name="name">
                        </div>
                        <div class="form-group">
                          <label for="namaMatkul">Email</label>
                          <input type="text" class="form-control" id="namaMatkul" placeholder="Masukkan Email..." name="email">
                        </div>
                        @if ($role == 'mahasiswa')    
                          <div class="form-group">
                            <label for="namaMatkul">Kode Mahasiswa</label>
                            <input type="text" class="form-control" id="namaMatkul" placeholder="Masukkan Kode Mahasiswa/NIM..." name="kode_mahasiswa">
                          </div>
                          <div class="form-group">
                            <label for="namaMatkul">Kelas</label>
                            <input type="text" class="form-control" id="namaMatkul" placeholder="Masukkan Kelas..." name="kelas">
                          </div>
                        @elseif ($role == 'dosen')    
                          <div class="form-group">
                            <label for="namaMatkul">Kode Dosen</label>
                            <input type="text" class="form-control" id="namaMatkul" placeholder="Masukkan Kode Dosen..." name="kode_dosen">
                          </div>
                        @endif
                        <div class="form-group">
                          <label for="namaMatkul">Password</label>
                          <input type="password" class="form-control" id="namaMatkul" placeholder="Masukkan Password..." name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
