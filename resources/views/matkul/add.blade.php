@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Mata Kuliah') }}</div>

                <div class="card-body">
                    
                    <form action="/matkul/add" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="kodeMatkul">Kode Matkul</label>
                          <input type="text" class="form-control" id="kodeMatkul" aria-describedby="emailHelp" placeholder="Masukkan Kode Matkul..." name="kodeMatkul">
                        </div>
                        <div class="form-group">
                          <label for="namaMatkul">Nama Matkul</label>
                          <input type="text" class="form-control" id="namaMatkul" aria-describedby="emailHelp" placeholder="Masukkan Kode Matkul..." name="namaMatkul">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
