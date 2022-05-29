@extends('layout.master')

@section('konten')
<h2>Data Siswa</h2>
@if (session()->has('success'))
<div class="alert alert-success mt-2" role="alert">
    {{session('success')}}  
</div>
@endif

@if (session()->has('error'))
<div class="alert alert-danger mt-2" role="alert">
    {{session('error')}}  
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
    <input type="number" class="form-control" id="nomor_induk" name="nomor_induk" value="{{old('nomor_induk',$datasiswa->nomor_induk)}}" disabled>
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Kelas:</label>
 <select class="form-control" aria-label="Default select example" name="kelas" id="kelas">
            <option value="{{$datasiswa->kelas}}">{{$datasiswa->kelas}}</option>
            <option value="12 IPA 1">12 IPA 1</option>
            <option value="12 IPA 2">12 IPA 2</option>
            <option value="12 IPA 3">12 IPA 3</option>
            <option value="12 IPA 4">12 IPA 4</option>
            <option value="12 IPS 1">12 IPS 1</option>
            <option value="12 IPS 2">12 IPS 2</option>
            <option value="12 IPS 3">12 IPS 3</option>
        </select>
  </div>
  

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">password lama:</label>
    <input type="password" class="form-control" id="password_lama" name="password_lama" >
  </div>
  
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">password baru:</label>
    <input type="password" class="form-control" id="password" name="password" >
  </div>

  <div class="modal-footer">
        <a href='/' class="btn btn-secondary" >Cancel</a>
    <button type="submit" class="btn btn-primary">Update</button>

</div>
</form> 
@endsection
