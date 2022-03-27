@extends('layout.master')

@section('konten')
<h2>Edit Prestasi</h2>
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

<form action="/update_prestasi" method="POST">
  @csrf
  <input type="hidden" name="id" value="{{$data_prestasi->id}}" id="id">

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama Peserta:</label>
    <input type="text" class="form-control" disabled value="{{old('nama_peserta',$data_prestasi->nama_peserta)}}">                                      
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama Ekskul:</label>
    <input type="text" class="form-control" disabled value="{{old('nama_ekskuls',$data_prestasi->nama_ekskuls)}}">                                      
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama Lomba:</label>
    <input type="text" class="form-control" id="nama_lomba" required name="nama_lomba" value="{{old('nama_lomba',$data_prestasi->nama_lomba)}}">                                      
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Prestasi:</label>
    <input type="text" class="form-control" id="prestasi" required name="prestasi" value="{{old('prestasi',$data_prestasi->prestasi)}}">                                      
  </div>

  <div class="mb-3">
  <label for="recipient-name" class="col-form-label">Tanggal:</label>
  <input type="date" class="form-control" id="tanggal" required name="tanggal" value="{{old('tanggal',$data_prestasi->tanggal)}}">
  </div>

  <div class="modal-footer">
  <a href='/daftar_prestasi/{{$data_prestasi->nama_ekskuls}}' class="btn btn-secondary" >Kembali</a>
  <button type="submit" class="btn btn-primary">Edit</button>

</div>
</form>


@endsection
