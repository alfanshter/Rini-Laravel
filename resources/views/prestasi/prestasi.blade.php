@extends('layout.master')


@section('konten')

    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Prestasi</h1>
                    @if (auth()->user()->role ==2)
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#tambahmateri">Tambah Prestasi</button>                        
                    <!-- Tambah Agenda-->
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
                                <form action="/agenda" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_pelatih" value="{{auth()->user()->nim}}" id="id_pelatih">
                                    <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Nama Peserta:</label>
                                    <select class="form-control" aria-label="Default select example" name="nama_ekskul" id="nama_ekskul">
                                        {{-- @foreach ($data_ekskuls as $data)
                                        <option value="{{$data->nama}}">{{$data->nama}}</option>                                                
                                        @endforeach --}}
                                    </select>
                                    </div>


                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nama Ekskul:</label>
                                        <select class="form-control" aria-label="Default select example" name="nama_ekskul" id="nama_ekskul">
                                            {{-- @foreach ($data_ekskuls as $data)
                                            <option value="{{$data->nama}}">{{$data->nama}}</option>                                                
                                            @endforeach --}}
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Prestasi:</label>
                                        <input type="text" class="form-control" id="tanggal" required name="tanggal" value="{{old('tangga')}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Tanggal:</label>
                                        <input type="date" class="form-control" id="tanggal" required name="tanggal" value="{{old('tangga')}}">
    
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nama Lomba:</label>
                                        <input type="text" class="form-control" id="tanggal" required name="tanggal" value="{{old('tangga')}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nama Pelatih:</label>
                                        <input type="text" class="form-control" id="tanggal" required name="tanggal" value="{{old('tangga')}}">
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
                                            <th>Nama Pelatih</th>
                                            @if (auth()->user()->role ==0)
                                            <th>Action</th>                                                
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($dataagenda as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->nama_materi}}</td>
                                            <td>{{$data->nama_ekskul}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->tanggal}}</td>    
                                            @if (auth()->user()->role ==2)
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-sm-center mt-2">                                                    
                                                        <a href="/agenda/{{$data->id}}" class="btn btn-warning ml-2">Edit</a>
                                                    <form action="/agenda/hapusagenda/{{$data->id}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger ml-2" onclick="return confirm('Apakah anda menyetujui ?')">Hapus</button>
                                                    </form>

                                                </div>
                                                </td>                                        


                                            @endif
                                        </tr>
                                        @endforeach --}}

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection