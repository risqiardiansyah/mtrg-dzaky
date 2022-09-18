@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Data Transaksi') }}</div>

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="/transaksi/add" type="button" class="btn btn-primary">Tambah</a>
                        <form action="/laporan/cetak" method="post">
                            @csrf
                            <div class="form-group">
                            <label for="kodeDosen">Dosen</label>
                            <select id="kodeDosen" class="form-control" name="kode_dosen">
                                <option value="">Semua Data</option>
                                @foreach ($dosen as $item)
                                    <option value="{{$item->kode_dosen}}">{{$item->nama_dosen}}</option>
                                @endforeach
                            </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                        </form>
                    </div>
                    
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
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
                                    <td>{{ $item->nama_matkul }}</td>
                                    <td>{{ $item->nama_dosen }}</td>
                                    <td>{{ $item->tahun_akademik }}</td>
                                    <td>{{ $item->semester }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>
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
