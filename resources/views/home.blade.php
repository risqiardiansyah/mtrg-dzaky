@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="/matkul/add" type="button" class="btn btn-primary">Tambah</a>
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kode Matkul</th>
                            <th scope="col">Nama Matkul</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->kode_matkul }}</td>
                                    <td>{{ $item->nama_matkul }}</td>
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
