@extends('layout.master')


@section('konten')

    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Nilai</h1>
                    @if (auth()->user()->role ==0)
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#tambahpengumuman">Tambah Nilai</button>                        
                        <!-- Pengumuman Modal-->
                    <div class="modal fade" id="tambahpengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/nilai" method="POST">
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
                                            <label for="recipient-name" class="col-form-label">Nilai</label>
                                            <input type="number" class="form-control" id="nilai" name="nilai" value="{{old('nilai')}}">
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
                        <button class="btn btn-primary"  data-toggle="modal" data-target="#tambahpengumuman">Tambah Nilai</button>                        
                            <!-- Pengumuman Modal-->
                        <div class="modal fade" id="tambahpengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/nilai" method="POST">
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
                                                <label for="recipient-name" class="col-form-label">Nilai</label>
                                                <input type="number" class="form-control" id="nilai" name="nilai" value="{{old('nilai')}}">
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

                    @error('nilai')
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
                            <h6 class="m-0 font-weight-bold text-primary p-2">Agenda</h6>
                            @if (auth()->user()->role==0 || auth()->user()->role==2 || auth()->user()->role==3  ||  auth()->user()->role ==4)
                            <button type="button" class="btn btn-primary ml-auto"  data-toggle="modal" data-target="#cetakpdf">Cetak PDF</button>
                                
                            {{-- CETAK PDF --}}
                                    <div class="modal fade" id="cetakpdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cetak PDF?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/cetakpdf_nilai"  method="GET">
                                                        @csrf
                                                        <input type="hidden" name="nama_ekskul" id="nama_ekskul" value="{{$nama_ekskul}}">  

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
                                                            <input type="text" class="form-control" required id="tahun_ajaran" name="tahun_ajaran" value="{{old('tahun_ajaran')}}">
                                                        </div>

                                                        <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Cetak</button>
                    
                                                    </div>
                                                    </form>
                                                </div>
                                                

                                            </div>
                                        </div>
                                    </div>
                            {{-- END CETAK PDF --}}                        
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nilai</th>
                                            <th>Predikat</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Semester</th>
                                            @if (auth()->user()->role ==2 || auth()->user()->role ==0)
                                            <th>Action</th>                                                
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nilai as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->nama_siswa}}</td>
                                            <td>{{$data->nilai}}</td>
                                            <td>
                                                @if ($data->nilai>=92)
                                                    A
                                                @endif

                                                @if ($data->nilai>=80 && $data->nilai<=91)
                                                    B
                                                @endif

                                                @if ($data->nilai<80)
                                                    C
                                                @endif
                                                
                                            </td>
                                            <td>{{$data->tahun_ajaran}}</td>
                                            <td>{{$data->semester}}</td>
                                            @if (auth()->user()->role ==2 || auth()->user()->role ==0 )
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-sm-center mt-2">
                                                
                                                    <a href="/nilai/{{$data->id}}" class="btn btn-warning">Edit</a>

                                                    <form action="/hapusnilai/{{$data->id}}" method="post">
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