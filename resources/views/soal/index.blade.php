@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Data Soal') }}</div>

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="/soal/add" type="button" class="btn btn-primary">Tambah</a>
                    </div>
                    
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Soal</th>
                            <th scope="col">Mata Kuliah</th>
                            <th scope="col">Nama Dosen</th>
                            <th scope="col">Tahun Akademik</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->nama_ujian }}</td>
                                    <td>{{ $item->nama_matkul }}</td>
                                    <td>{{ $item->nama_dosen }}</td>
                                    <td>{{ $item->tahun_akademik }}</td>
                                    <td>{{ $item->semester }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>
                                        <a href="/soal/list/{{$item->tr_data_code}}" type="button" class="btn btn-primary">List Soal</a>
                                        <a href="/matkul/edit/{{$item->id}}" type="button" class="btn btn-warning">Edit</a>
                                        <a type="button" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin?');" href="matkul/delete/{{$item->id}}">delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
