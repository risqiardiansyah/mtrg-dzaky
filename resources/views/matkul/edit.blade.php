@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Mata Kuliah') }}</div>

                <div class="card-body">
                    
                    <form action="/matkul/edit" method="post">
                        @csrf
                        <input type="hidden" class="form-control" id="id" aria-describedby="emailHelp" name="id" value="{{$id}}">
                        <div class="form-group">
                          <label for="kodeMatkul">Kode Matkul</label>
                          <input type="text" class="form-control" id="kodeMatkul" aria-describedby="emailHelp" placeholder="Masukkan Kode Matkul..." name="kodeMatkul" value="{{$data->kode_matkul}}">
                        </div>
                        <div class="form-group">
                          <label for="namaMatkul">Nama Matkul</label>
                          <input type="text" class="form-control" id="namaMatkul" aria-describedby="emailHelp" placeholder="Masukkan Kode Matkul..." name="namaMatkul" value="{{$data->nama_matkul}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
