@extends('layout.master')


@section('konten')

    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Wali Kelas</h1>
                    @if (auth()->user()->role ==0)
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#tambahsiswa">Tambah Wali Kelas</button>                        
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2" role="alert">
                            {{session('success')}}  
                        </div>
                    @endif

                    @if (session()->has('failed'))
                        <div class="alert alert-danger mt-2" role="alert">
                            {{session('failed')}}  
                        </div>
                    @endif

                    @error('username')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror

                    @error('name')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror

                    @error('nomor_induk')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror

                 

                    @error('nohp')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror

                    @error('password')
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
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Wali Kelas?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/walikelas" method="POST">
                                        @csrf
                                      <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nama:</label>
                                        <input type="text" class="form-control" id="name" required name="name" value="{{old('name')}}">
                                      </div>
                                      <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Kode Wali Kelas:</label>
                                        <input type="text" class="form-control" id="nomor_induk" required name="nomor_induk" value="{{old('nomor_induk')}}">
                                      </div>
                                      <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nomor HP:</label>
                                        <input type="number" class="form-control" id="nohp" required name="nohp" value="{{old('nomor_induk')}}">
                                      </div>


                                      <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Username:</label>
                                        <input type="text" class="form-control" id="username" required name="username" value="{{old('username')}}">
                                      </div>

                                      <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Password:</label>
                                        <input type="password" class="form-control" id="password" required name="password">
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Wali Kelas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            
                                            <th>Username</th>
                                            <th>Kode</th>
                                            <th>Nomor HP</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($walikelas as $data)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>                                        
                                                <td>{{$data->name}}</td>                                        
                                                                                        
                                                <td>{{$data->username}}</td>                                        
                                                <td>{{$data->nomor_induk}}</td>                                        
                                                <td>{{$data->nohp}}</td>                                        
                                                <td>{{$data->created_at}}</td>
                                                <td class="align-middle text-center">
                                                <div class="d-flex justify-content-sm-center mt-2">
                                                    
                                                    <a href="walikelas/editwalikelas/{{$data->id}}" class="btn btn-warning">Edit</a>
                                                    <form action="/walikelas/hapuswalikelas/{{$data->id}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger ml-2" onclick="return confirm('Apakah anda akan menghapus data ?')">Hapus</button>
                                                    </form>

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