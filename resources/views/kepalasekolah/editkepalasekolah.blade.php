@extends('layout.master')

@section('konten')
<h2>Edit Kepala Sekolah</h2>

@error('username')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror

@error('name')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror

@error('nomor_induk')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror


@error('nohp')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror


<form action="/kepalasekolah/updatekepalasekolah" method="POST">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$kepalasekolah->id}}">
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama:</label>
    <input type="text" class="form-control" id="name" name="name" value="{{old('name',$kepalasekolah->name)}}">
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Kode Kepala Sekolah:</label>
    <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" value="{{old('nomor_induk',$kepalasekolah->nomor_induk)}}">
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">No Hp:</label>
    <input type="number" class="form-control" id="nohp" name="nohp" value="{{old('nohp',$kepalasekolah->nohp)}}">
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Username:</label>
    <input type="text" class="form-control" id="username" name="username" value="{{old('username',$kepalasekolah->username)}}">
  </div>

      <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Password:</label>
        <input type="text" class="form-control" id="password" name="password">
    </div>

  <div class="modal-footer">
    <a href="/kepalasekolah" class="btn btn-dark">Cancel</a>
    <button type="submit" class="btn btn-primary">Update</button>

</div>
</form> 
@endsection
