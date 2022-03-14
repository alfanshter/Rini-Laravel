@extends('layout.master')

@section('konten')
<h2>Edit Data Ekskul</h2>
@error('kode')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror

@error('nama')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror

<form action="/dataekskul/updateekskul" method="POST">
  @csrf
  <input type="hidden" name="id" id="id" value="{{$data_ekskul->id}}">
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Kode:</label>
    <input type="text" required class="form-control" id="kode" name="kode" value="{{old('kode',$data_ekskul->kode)}}">
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama:</label>
    <input type="text" required class="form-control" id="nama" name="nama" value="{{old('nama',$data_ekskul->nama)}}">
  </div>

<div class="modal-footer">
  <a href="/dataekskul" class="btn btn-secondary"> Cancel </a>
  <button type="submit" class="btn btn-primary">Edit</button>

</div>
</form>

@endsection
