@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List Soal') }}</div>

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah
                        </button>
                    </div>
                    
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pertanyaan</th>
                            <th scope="col">Option A</th>
                            <th scope="col">Option B</th>
                            <th scope="col">Option C</th>
                            <th scope="col">Option D</th>
                            <th scope="col">Option E</th>
                            <th scope="col">Kunci Jawaban</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->desc_soal }}</td>
                                    <td>{{ $item->option_a }}</td>
                                    <td>{{ $item->option_b }}</td>
                                    <td>{{ $item->option_c }}</td>
                                    <td>{{ $item->option_d }}</td>
                                    <td>{{ $item->option_e }}</td>
                                    <td>{{ $item->kunci_jawaban }}</td>
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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Soal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/soal/list/add" method="post">
                @csrf
                <input type="hidden" value="{{$kode_soal}}" name="tr_data_code">
                <div class="form-group">
                    <label for="pertanyaan">Pertanyaan</label>
                    <input type="text" class="form-control" id="pertanyaan" aria-describedby="emailHelp" placeholder="Masukkan pertanyaan..." name="desc_soal">
                </div>
                <div class="form-group">
                    <label for="option_a">Option A</label>
                    <input type="text" class="form-control" id="option_a" aria-describedby="emailHelp" placeholder="Masukkan option A..." name="option_a">
                </div>
                <div class="form-group">
                    <label for="option_b">Option B</label>
                    <input type="text" class="form-control" id="option_b" aria-describedby="emailHelp" placeholder="Masukkan option B..." name="option_b">
                </div>
                <div class="form-group">
                    <label for="option_c">Option C</label>
                    <input type="text" class="form-control" id="option_c" aria-describedby="emailHelp" placeholder="Masukkan option C..." name="option_c">
                </div>
                <div class="form-group">
                    <label for="option_d">Option D</label>
                    <input type="text" class="form-control" id="option_d" aria-describedby="emailHelp" placeholder="Masukkan option D..." name="option_d">
                </div>
                <div class="form-group">
                    <label for="option_e">Option E</label>
                    <input type="text" class="form-control" id="option_e" aria-describedby="emailHelp" placeholder="Masukkan option E..." name="option_e">
                </div>
                <div class="form-group">
                    <label for="kunci_jawaban">Kunci Jawaban</label>
                    <select id="kunci_jawaban" class="form-control" name="kunci_jawaban">
                        <option value="option_a">Option A</option>
                        <option value="option_b">Option B</option>
                        <option value="option_c">Option C</option>
                        <option value="option_d">Option D</option>
                        <option value="option_e">Option E</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>
@endsection
