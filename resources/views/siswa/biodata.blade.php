@extends('layout.master')

@section('konten')
<h2>Data Siswa</h2>
@if (session()->has('success'))
<div class="alert alert-success mt-2" role="alert">
    {{session('success')}}  
</div>
@endif

@error('password')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror



<form action="/datasiswa/updatepassword" method="POST">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$datasiswa->id}}">
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama:</label>
    <input type="text" class="form-control" id="name" name="name" value="{{old('name',$datasiswa->name)}}" disabled>
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">NISN:</label>
    <input type="number" class="form-control" id="nim" name="nim" value="{{old('nim',$datasiswa->nim)}}" disabled>
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Kelas:</label>
    <input type="text" class="form-control" id="nim" name="nim" value="{{old('kelas',$datasiswa->kelas)}}" disabled>
  </div>
  <div class="mb-3">
    <label for="message-text" class="col-form-label">Alamat:</label>
    <textarea class="form-control" id="alamat" name="alamat" disabled >{{old('alamat',$datasiswa->alamat)}}</textarea>
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">password lama:</label>
    <input type="password" class="form-control" id="password_lama" name="password_lama" required>
  </div>
  
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">password baru:</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Update</button>

</div>
</form> 
@endsection
