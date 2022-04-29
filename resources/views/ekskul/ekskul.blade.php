@extends('layout.master')


@section('konten')

    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Ekskul</h1>
                    @if (auth()->user()->role ==0)
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#tambahsiswa">Tambah Ekskul</button>                        
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2" role="alert">
                            {{session('success')}}  
                        </div>
                    @endif

                    @error('kode')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror
                    
                      <!-- Logout Modal-->
                    <div class="modal fade" id="tambahsiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Ekskul?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/dataekskul" method="POST">
                                        @csrf
                                    
                                      <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Kode:</label>
                                        <input type="text" required class="form-control" id="kode" name="kode" value="{{old('kode')}}">
                                      </div>

                                      <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nama:</label>
                                        <input type="text" required class="form-control" id="nama" name="nama" value="{{old('nama')}}">
                                      </div>

                                      <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
    
                                    </div>
                                    </form>
                                  </div>
                                

                            </div>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Ekskul</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataekskul as $data)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>                                        
                                                <td>{{$data->kode}}</td>                                        
                                                <td>{{$data->nama}}</td>                                        
                                                <td>{{$data->created_at}}</td>                                        
                                                <td class="align-middle text-center">
                                                <div class="d-flex justify-content-sm-center mt-2">
                                                    
                                                    <a href="dataekskul/editekskul/{{$data->id}}" class="btn btn-warning">Edit</a>
                                                    <a href="/dataekskul/destroy/{{$data->id}}" class="btn btn-danger ml-2" onclick="return confirm('Apakah anda akan menghapus data ?')">Hapus</a>

                                                </div>
                                                </td>                                        

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection