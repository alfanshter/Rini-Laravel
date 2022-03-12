@extends('layout.master')

@section('konten')
<h2>Edit Siswa</h2>
@error('nim')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror
@error('name')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror
@error('alamat')
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
    <label for="recipient-name" class="col-form-label">NIM:</label>
    <input type="number" class="form-control" id="nim" name="nim" value="{{old('nim',$datasiswa->nim)}}">
  </div>
  <div class="mb-3">
    <label for="message-text" class="col-form-label">Alamat:</label>
    <textarea class="form-control" id="alamat" name="alamat" >{{old('alamat',$datasiswa->alamat)}}</textarea>
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Kelas:</label>
    <input type="text" class="form-control" id="kelas" name="kelas" value="{{old('kelas',$datasiswa->kelas)}}">
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Username:</label>
    <input type="text" class="form-control" id="username" name="username" value="{{old('username',$datasiswa->username)}}">
  </div>




  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Update</button>

</div>
</form> 
@endsection
