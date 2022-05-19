@extends('layout.master')

@section('konten')
<h2>Edit Siswa</h2>
@error('nomor_induk')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}
</div>
@enderror
@error('name')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}
</div>
@enderror

@error('kelas')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}
</div>
@enderror
@error('username')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}
</div>
@enderror
<form action="/datasiswa/updatesiswa" method="POST">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$datasiswa->id}}">
    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Nama:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name',$datasiswa->name)}}">
    </div>
    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">NISN:</label>
        <input type="number" class="form-control" id="nomor_induk" name="nomor_induk" value="{{old('nomor_induk',$datasiswa->nomor_induk)}}">
    </div>
    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Kelas:</label>
        <input type="text" class="form-control" id="kelas" name="kelas" value="{{old('kelas',$datasiswa->kelas)}}">
    </div>

    <div class="mb-3">
        <label for="message-text" class="col-form-label">Jenis Kelamin:</label>
        <select class="form-control" aria-label="Default select example" name="jenis_kelamin" id="jenis_kelamin">
            <option value="{{$datasiswa->jenis_kelamin}}">{{$datasiswa->jenis_kelamin}}</option>
            <option value="Perempuan">Perempuan</option>
            <option value="Laki - laki">Laki - laki</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Username:</label>
        <input type="text" class="form-control" id="username" required name="username" value="{{old('username',$datasiswa->username)}}">
    </div>

    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Password:</label>
        <input type="text" class="form-control" id="password" name="password">
    </div>




    <div class="modal-footer">
        <a href="/datasiswa" class="btn btn-dark">Cancel</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
@endsection