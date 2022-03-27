@extends('layout.master')


@section('konten')

    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Peserta</h1>
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
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3 d-flex">
                            <h6 class="m-0 font-weight-bold text-primary p-2">Data Ekskul</h6>
                            <form action="/cetakpdf_peserta" class=" ml-auto p-2" method="post">
                            @csrf
                            <input type="hidden" name="kode" id="kode" value="{{$kode_ekskul}}">
                            <button type="submit"  class="btn btn-primary">Cetak Pdf</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">No</th>
                                            <th class="align-middle text-center">Nama</th>
                                            <th class="align-middle text-center">Kelas</th>
                                            <th class="align-middle text-center">J/K</th>
                                            <th class="align-middle text-center">NISN</th>
                                            <th class="align-middle text-center">Nama Ekskul</th>
                                            <th class="align-middle text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peserta as $data)
                                        <tr>
                                            <td class="align-middle text-center">{{$loop->iteration}}</td>                                        
                                            <td class="align-middle text-center">{{$data->name}}</td>
                                            <td class="align-middle text-center">{{$data->kelas}}</td>
                                            <td class="align-middle text-center">{{$data->jenis_kelamin}}</td>
                                            <td class="align-middle text-center">{{$data->nim}}</td>
                                            <td class="align-middle text-center">{{$data->nama}}</td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-sm-center mt-2">
                                                    <form action="/delete_peserta" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" id="id" value="{{$data->id}}">
                                                        <input type="hidden" name="kode" id="kode" value="{{$data->kode}}">
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah ingin mengeluarkan peserta ini ?')" >Hapus Peserta</button>
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