@extends('layout.master')

@section('konten')
<h2>Data Pelatih</h2>
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



<form action="/pelatih/updatepassword" method="POST">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$datapelatih->id}}">
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama:</label>
    <input type="text" class="form-control" id="name" name="name" value="{{old('name',$datapelatih->name)}}" disabled>
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Kode Pelatih:</label>
    <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" value="{{old('nomor_induk',$datapelatih->nomor_induk)}}" disabled>
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">No HP:</label>
    <input type="text" class="form-control" id="nohp" name="nohp" value="{{old('nohp',$datapelatih->nohp)}}">
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
