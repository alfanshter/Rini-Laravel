@extends('layout.master')


@section('konten')


<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Informasi Ekskul</h1>
@if (auth()->user()->role ==0)
<button class="btn btn-primary" data-toggle="modal" data-target="#tambahsiswa">Tambah Informasi Ekskul</button>
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

@error('kode_pelatih')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}
</div>
@enderror

@error('tempat_ekskul')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}
</div>
@enderror

@error('jam')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}
</div>
@enderror

@error('jadwal')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}
</div>
@enderror

@error('id_data_ekskul')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}
</div>
@enderror

<!-- Logout Modal-->
<div class="modal fade" id="tambahsiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Informasi Ekskul ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/informasiekskul" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nama:</label>
                        <select class="form-control" aria-label="Default select example" name="id_data_ekskul" id="id_data_ekskul">
                            @foreach ($data_ekskul as $data)
                            <option value="{{$data->kode}}">{{$data->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Jadwal:</label>
                        <select class="form-control" aria-label="Default select example" name="jadwal" id="jadwal">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Pukul:</label>
                        <input type="time" class="form-control" id="jam" required name="jam" value="{{old('jam')}}">
                    </div>

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Tempat:</label>
                        <textarea class="form-control" id="tempat_ekskul" required name="tempat_ekskul" value="{{old('tempat_ekskul')}}"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Pelatih:</label>
                        <select class="form-control" aria-label="Default select example" name="kode_pelatih" id="kode_pelatih">
                            @foreach ($data_pelatih as $data)
                            <option value="{{$data->nomor_induk}}">{{$data->name}}</option>
                            @endforeach
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
<!-- DataTales Example -->
<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Informasi Ekskul</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jadwal</th>
                        <th>Jam</th>
                        <th>Tempat</th>
                        <th>Pelatih</th>
                        @if (auth()->user()->role ==0)
                        <th>Action</th>
                        @endif
                        @if (auth()->user()->role ==1)
                        <th>Action</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach ($informasiekskul as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{$data->jadwal}}</td>
                        <td>{{$data->jam}}</td>
                        <td>{{$data->tempat_ekskul}}</td>
                        <td>{{$data->name}}</td>
                        @if (auth()->user()->role ==0)
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-sm-center mt-2">

                                <a href="informasiekskul/editinformasiekskul/{{$data->id}}" class="btn btn-warning">Edit</a>
                                <form action="/informasiekskul/hapusinformasiekskul/{{$data->id}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger ml-2" onclick="return confirm('Apakah anda akan menghapus data ?')">Hapus</button>
                                </form>

                            </div>
                        </td>
                        @endif

                        @if (auth()->user()->role ==1)
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-sm-center mt-2">
                                <a href="ekskul/pendaftaran/{{$data->id}}" class="btn btn-primary">Register</a>
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