@extends('layout.master')

@section('konten')
<h2>Edit Nilai</h2>
@error('nama_lomba')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}
</div>
@enderror

@error('prestasi')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}
</div>
@enderror

@if (session()->has('success'))
<div class="alert alert-success mt-2" role="alert">
    {{session('success')}}
</div>
@endif

<form action="/update_nilai" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$nilai->id}}" id="id">
    <input type="hidden" name="nama_ekskul" value="{{$nilai->nama_ekskul}}" id="nama_ekskul">

    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Nama Siswa:</label>
        <input type="text" class="form-control" disabled value="{{old('nama_siswa',$nilai->nama_siswa)}}">
    </div>

    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Semester:</label>
        <select class="form-control" aria-label="Default select example" name="semester" id="semester">
            <option value="{{$nilai->semester}}">
                <p>{{$nilai->semester}}</p>
            </option>
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
        <input type="text" class="form-control" id="tahun_ajaran" required name="tahun_ajaran" value="{{old('tahun_ajaran',$nilai->tahun_ajaran)}}">
    </div>

    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Nilai:</label>
        <input type="text" class="form-control" id="nilai" required name="nilai" value="{{old('nilai',$nilai->nilai)}}">
    </div>

    <div class="modal-footer">
        <a href='/data_nilai/{{$nilai->nama_ekskul}}' class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Edit</button>

    </div>
</form>


@endsection