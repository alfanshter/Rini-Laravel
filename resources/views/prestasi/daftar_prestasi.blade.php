@extends('layout.master')


@section('konten')

    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Prestasi</h1>
                    @if (auth()->user()->role ==2)
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#tambahmateri">Tambah Prestasi</button>                        
                    <!-- Tambah Prestasi-->
                    <div class="modal fade" id="tambahmateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi ?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/prestasi" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="kode_pelatih" value="{{auth()->user()->nomor_induk}}" id="kode_pelatih">
                                    <input type="hidden" name="id_data_ekskul" value="{{$id_data_ekskul}}" id="id_data_ekskul">
                                    <input type="hidden" name="nama_pelatih" value="{{auth()->user()->name}}" id="nama_pelatih">
                                    <input type="hidden" name="kode_pelatih" value="{{auth()->user()->nomor_induk}}" id="kode_pelatih">

                                    <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Nama Peserta:</label>
                                    <select class="form-control" aria-label="Default select example" name="nomor_induk" id="nama_peserta">
                                        @foreach ($nama_peserta as $data)
                                        <option value="{{$data->nomor_induk}}">{{$data->name}}</option>                                                
                                        @endforeach
                                    </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Prestasi:</label>
                                        <input type="text" class="form-control" id="prestasi" required name="prestasi" value="{{old('prestasi')}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Tanggal:</label>
                                        <input type="date" class="form-control" id="tanggal" required name="tanggal" value="{{old('tanggal')}}">
    
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nama Lomba:</label>
                                        <input type="text" class="form-control" id="nama_lomba" required name="nama_lomba" value="{{old('nama_lomba')}}">
                                    </div>

                                                                        <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Foto:</label>
                                        <input type="file" class="form-control" id="foto" required name="foto" value="{{old('foto')}}">
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
                    @endif
                    @error('foto')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror
                    
                    @if (auth()->user()->role ==0)
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#tambahmateri">Tambah Prestasi</button>                        
                    <!-- Tambah Prestasi-->
                    <div class="modal fade" id="tambahmateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi ?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/prestasi" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if (auth()->user()->role ==2)
                                    <input type="hidden" name="kode_pelatih" value="{{auth()->user()->nomor_induk}}" id="kode_pelatih">
                                    <input type="hidden" name="id_data_ekskul" value="{{$id_data_ekskul}}" id="id_data_ekskul">
                                    <input type="hidden" name="nama_pelatih" value="{{auth()->user()->name}}" id="nama_pelatih">
                                    @endif
                                    @if (auth()->user()->role ==0)
                                    <input type="hidden" name="kode_pelatih" value="{{$pelatih->kode_pelatih}}" id="kode_pelatih">
                                    <input type="hidden" name="id_data_ekskul" value="{{$id_data_ekskul}}" id="id_data_ekskul">
                                    <input type="hidden" name="nama_pelatih" value="{{$pelatih->nama_pelatih}}" id="nama_pelatih">                                        
                                    @endif
                                    <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Nama Peserta:</label>
                                    <select class="form-control" aria-label="Default select example" name="nomor_induk" id="nomor_induk">
                                        @foreach ($nama_peserta as $data)
                                        <option value="{{$data->nomor_induk}}">{{$data->name}}</option>                                                
                                        @endforeach
                                    </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Prestasi:</label>
                                        <input type="text" class="form-control" id="prestasi" required name="prestasi" value="{{old('prestasi')}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Tanggal:</label>
                                        <input type="date" class="form-control" id="tanggal" required name="tanggal" value="{{old('tanggal')}}">
    
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nama Lomba:</label>
                                        <input type="text" class="form-control" id="nama_lomba" required name="nama_lomba" value="{{old('nama_lomba')}}">
                                    </div>

                                    
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Foto:</label>
                                        <input type="file" class="form-control" id="foto" required name="foto" value="{{old('foto')}}">
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
                    @endif
                 

                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2" role="alert">
                            {{session('success')}}  
                        </div>
                    @endif

                    @error('kode_pelatih')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror


                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Prestasi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Peserta</th>
                                            <th>Nama Ekskul</th>
                                            <th>Prestasi</th>
                                            <th>Tanggal</th>
                                            <th>Nama Lomba</th>
                                            <th>Foto</th>
                                            @if (auth()->user()->role ==2 || auth()->user()->role ==0)
                                            <th>Action</th>                                                
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataprestasi as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->user->name}}</td>
                                            <td>{{$data->ekskul->nama}}</td>
                                            <td>{{$data->prestasi}}</td>
                                            <td>{{$data->tanggal}}</td>    
                                            <td>{{$data->nama_lomba}}</td>    
                                            <td><img src="{{asset('storage/'. $data->foto)}}" width="150" height="150" alt="" srcset=""></td>    
                                            @if (auth()->user()->role ==2 || auth()->user()->role ==0)
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-sm-center mt-2">                                                    
                                                        <a href="/prestasi/{{$data->id}}" class="btn btn-warning ml-2">Edit</a>
                                                    <form action="/prestasi/hapusprestasi" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$data->id}}">
                                                        <input type="hidden" name="foto" value="{{$data->foto}}">
                                                        <button class="btn btn-danger ml-2" onclick="return confirm('Apakah anda menyetujui ?')">Hapus</button>
                                                    </form>

                                                </div>
                                                </td>                                        


                                            @endif
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection