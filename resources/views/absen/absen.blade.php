@extends('layout.master')


@section('konten')

    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">absen</h1>
                    @if (auth()->user()->role ==0)
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#tambahpengumuman">Tambah absen</button>                        
                        <!-- Pengumuman Modal-->
                    <div class="modal fade" id="tambahpengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah absen?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/absen" method="POST">
                                        @csrf
                                        <input type="hidden" name="nama_ekskul" id="nama_ekskul" value="{{$nama_ekskul}}">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Nama Siswa:</label>
                                            <select class="form-control" aria-label="Default select example" name="id_siswa" id="id_siswa">
                                                @foreach ($nama_siswa as $data)
                                                <option value="{{$data->nim}}">
                                                    {{$data->name}}
                                                </option>                                                
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Absen:</label>
                                            <select class="form-control" aria-label="Default select example" name="absen" id="absen">
                                                <option value="2">
                                                    A
                                                </option>                                                
                                                <option value="3">
                                                    I
                                                </option>                                               
                                                <option value="4">
                                                    S
                                                </option>                                                
                                                <option value="1">
                                                    M
                                                </option>                                                  
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Tanggal:</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{old('tanggal')}}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Semester:</label>
                                            <select class="form-control" aria-label="Default select example" name="semester" id="semester">
                                                <option value="ganjil">
                                                    GANJIL
                                                </option>                                                
                                                <option value="genap">
                                                    GENAP
                                                </option>                                                

                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Tahun Ajaran:</label>
                                            <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="{{old('tahun_ajaran')}}">
                                            <p>Cara penulisan : 2022-2021</p>
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


                    @if (auth()->user()->role ==2)
                        <button class="btn btn-primary"  data-toggle="modal" data-target="#tambahpengumuman">Tambah absen</button>                        
                            <!-- Pengumuman Modal-->
                        <div class="modal fade" id="tambahpengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah absen?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/absen" method="POST">
                                            @csrf
                                            <input type="hidden" name="nama_ekskul" id="nama_ekskul" value="{{$nama_ekskul}}">
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Nama Siswa:</label>
                                                <select class="form-control" aria-label="Default select example" name="id_siswa" id="id_siswa">
                                                    @foreach ($nama_siswa as $data)
                                                    <option value="{{$data->nim}}">
                                                        {{$data->name}}
                                                    </option>                                                
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Tanggal:</label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{old('tanggal')}}">
                                            </div>
    
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Semester:</label>
                                                <select class="form-control" aria-label="Default select example" name="semester" id="semester">
                                                    <option value="ganjil">
                                                        GANJIL
                                                    </option>                                                
                                                    <option value="genap">
                                                        GENAP
                                                    </option>                                                

                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Tahun Ajaran:</label>
                                                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="{{old('tahun_ajaran')}}">
                                                <p>Cara penulisan : 2022-2021</p>
                                            </div>

                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Absen:</label>
                                                <select class="form-control" aria-label="Default select example" name="absen" id="absen">
                                                    <option value="2">
                                                        A
                                                    </option>                                                
                                                    <option value="3">
                                                        I
                                                    </option>                                               
                                                    <option value="4">
                                                        S
                                                    </option>                                                
                                                    <option value="1">
                                                        M
                                                    </option>                                                  
                                                </select>
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

                    @error('absen')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror

                    @error('nama_ekskul')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror

                    @error('nama_siswa')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror
                    
                    @error('id_siswa')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3 d-flex">
                            <h6 class="m-0 font-weight-bold text-primary p-2">Absen</h6>
                            @if (auth()->user()->role==0 || auth()->user()->role==2)
                            <form class="ml-auto" action="/cetakpdf_absen/{{$nama_ekskul}}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary">Cetak PDF</button>
                            </form>                                
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Absen</th>
                                            <th>Semester</th>
                                            <th>Tahun ajaran</th>
                                            <th>Tanggal</th>
                                            @if (auth()->user()->role ==2 || auth()->user()->role ==0)
                                            <th>Action</th>                                                
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absen as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->nama_siswa}}</td>
                                            <td>{{$data->kelas}}</td>
                                            @if ($data->absen == 1)
                                            <td>Masuk</td>                                                
                                            @endif
                                            @if ($data->absen == 2)
                                            <td>A</td>                                                
                                            @endif
                                            @if ($data->absen == 3)
                                            <td>Ijin</td>                                                
                                            @endif
                                            @if ($data->absen == 4)
                                            <td>Sakit</td>                                                
                                            @endif
                                            <td>{{$data->semester}}</td>
                                            <td>{{$data->tahun_ajaran}}</td>
                                            <td>{{$data->tanggal}}</td>


                                            @if (auth()->user()->role ==2 || auth()->user()->role ==0)
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-sm-center mt-2">
                                                
                                                    <a href="/absen/{{$data->id}}" class="btn btn-warning">Edit</a>

                                                    <form action="/hapusabsen/{{$data->id}}" method="post">
                                                        @method('delete')
                                                        @csrf
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