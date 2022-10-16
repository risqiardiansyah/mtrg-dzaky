@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List Pengguna') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah
                    </button>
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role }}</td>
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

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Role Pengguna</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-12 m-3">
                    <a href="/pengguna/add/admin">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                            <h2 class="card-title text-center">Admin</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 m-3">
                    <a href="/pengguna/add/dosen">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body"> 
                            <h2 class="card-title text-center">Dosen</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 m-3">
                    <a href="/pengguna/add/mahasiswa">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                            <h2 class="card-title text-center">Mahasiswa</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
</div>
</div>
@endsection
