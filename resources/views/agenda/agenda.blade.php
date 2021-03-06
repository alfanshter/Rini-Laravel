@extends('layout.master')


@section('konten')


<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Agenda</h1>
@if (auth()->user()->role ==0)
<button class="btn btn-primary" data-toggle="modal" data-target="#tambahagenda">Tambah Agenda</button>
<div class="modal fade" id="tambahagenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Agenda ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/post_agenda" method="POST">
                    @csrf
                    <input type="hidden" name="kode_pelatih" value="{{$pelatih->kode_pelatih}}" id="kode_pelatih">
                    <input type="hidden" name="id_data_ekskul" value="{{$nama_ekskul}}" id="id_data_ekskul">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nama Materi:</label>
                        <input type="text" class="form-control" id="nama_materi" required name="nama_materi" value="{{old('nama_materi')}}">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Semester:</label>
                        <select class="form-control" aria-label="Default select example" name="semester" id="semester">
                            <option value="GANJIL">
                                GANJIL
                            </option>
                            <option value="GENAP">
                                GENAP
                            </option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tahun Ajaran:</label>
                        <input type="text" class="form-control" required id="tahun_ajaran" name="tahun_ajaran" value="{{old('tahun_ajaran')}}">
                        <p>Cara penulisan : 2022-2021</p>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal" required name="tanggal" value="{{old('tangga')}}">
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
<button class="btn btn-primary" data-toggle="modal" data-target="#tambahmateri">Tambah Agenda</button>
<!-- Tambah Agenda-->
<div class="modal fade" id="tambahmateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Agenda ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/post_agenda" method="POST">
                    @csrf
                    <input type="hidden" name="kode_pelatih" value="{{auth()->user()->nomor_induk}}" id="kode_pelatih">
                    <input type="hidden" name="id_data_ekskul" value="{{$nama_ekskul}}" id="id_data_ekskul">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nama Materi:</label>
                        <input type="text" class="form-control" id="nama_materi" required name="nama_materi" value="{{old('nama_materi')}}">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Semester:</label>
                        <select class="form-control" aria-label="Default select example" name="semester" id="semester">
                            <option value="GANJIL">
                                GANJIL
                            </option>
                            <option value="GENAP">
                                GENAP
                            </option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tahun Ajaran:</label>
                        <input type="text" class="form-control" required id="tahun_ajaran" name="tahun_ajaran" value="{{old('tahun_ajaran')}}">
                        <p>Cara penulisan : 2022-2021</p>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal" required name="tanggal" value="{{old('tangga')}}">
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
    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary p-2">Agenda</h6>
        @if (auth()->user()->role==0 || auth()->user()->role==2 || auth()->user()->role==3)
        {{-- <form class="ml-auto" action="/cetakpdf_agenda_pelatih/{{$nama_ekskul}}" method="GET">
        @csrf
        <button type="submit" class="btn btn-primary">Cetak PDF</button>
        </form> --}}
        <button type="submit" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#cetakpdf">Cetak PDF</button>

        {{-- CETAK PDF --}}
        <div class="modal fade" id="cetakpdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cetak PDF?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/cetakpdf_agenda_pelatih" method="GET">
                            @csrf
                            <input type="hidden" name="nama_ekskul" id="nama_ekskul" value="{{$nama_ekskul}}">

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Semester:</label>
                                <select class="form-control" aria-label="Default select example" name="semester" id="semester">
                                    <option value="GANJIL">
                                        GANJIL
                                    </option>
                                    <option value="GENAP">
                                        GENAP
                                    </option>

                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Tahun Ajaran:</label>
                                <select class="form-control" aria-label="Default select example" name="tahun_ajaran" id="tahun_ajaran">
                                    @foreach ($tahun_ajaran as $item)
                                    <option value="{{$item->tahun_ajaran}}">
                                        {{$item->tahun_ajaran}}
                                    </option>
                                    @endforeach

                                </select>
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
                        <th>Materi</th>
                        <th>Nama Ekskul</th>
                        <th>Pelatih</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Tanggal</th>
                        @if (auth()->user()->role ==2 || auth()->user()->role ==0)
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataagenda as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->nama_materi}}</td>
                        <td>{{$data->agenda_to_ekskul->nama}}</td>
                        <td>{{$data->users->name}}</td>
                        <td>{{$data->tahun_ajaran}}</td>
                        <td>{{$data->semester}}</td>
                        <td>{{$data->tanggal}}</td>
                        @if (auth()->user()->role ==2 || auth()->user()->role ==0)
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
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection