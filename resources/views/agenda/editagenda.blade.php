@extends('layout.master')

@section('konten')
<h2>Edit Agenda</h2>
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

@if (session()->has('success'))
<div class="alert alert-success mt-2" role="alert">
    {{session('success')}}  
</div>
@endif

<form action="/updateagenda" method="POST">
  @csrf
  <input type="hidden" name="id" value="{{$dataagenda->id}}" id="id">
  <input type="hidden" name="nama_ekskul" value="{{$dataagenda->nama_ekskul}}" id="nama_ekskul">
  <div class="mb-3">
  <label for="recipient-name" class="col-form-label">Nama Materi:</label>
  <input type="text" class="form-control" id="nama_materi" required name="nama_materi" value="{{old('nama_materi',$dataagenda->nama_materi)}}">                                      </div>
  <div class="mb-3">
  <label for="recipient-name" class="col-form-label">Tanggal:</label>
  <input type="date" class="form-control" id="tanggal" required name="tanggal" value="{{old('tanggal',$dataagenda->tanggal)}}">
  </div>

  <div class="modal-footer">
  <a href="{{url()->previous()}}" class="btn btn-secondary" >Cancel</a>
  <button type="submit" class="btn btn-primary">Edit</button>

</div>
</form>


@endsection
