@extends('layout.master')

@section('konten')
<h2>Edit Pelatih</h2>
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
<form action="/datapelatih/updatepelatih" method="POST">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$datapelatih->id}}">
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama:</label>
    <input type="text" class="form-control" id="name" name="name" value="{{old('name',$datapelatih->name)}}">
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Kode Pelatih:</label>
    <input type="text" oninvalid="this.setCustomValidity('Kode pelatih wajib diisi')" class="form-control" id="nomor_induk" required name="nomor_induk" value="{{old('nomor_induk',$datapelatih->nomor_induk)}}">
  </div>
  

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">No Hp:</label>
    <input type="number" class="form-control" id="nohp" name="nohp" value="{{old('nohp',$datapelatih->nohp)}}">
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Username:</label>
    <input type="text" class="form-control" id="username" name="username" value="{{old('username',$datapelatih->username)}}">
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Password:</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>




  <div class="modal-footer">
    <a href="/pelatih" class="btn btn-dark">Cancel</a>
    <button type="submit" class="btn btn-primary">Edit</button>

</div>
</form> 
@endsection
