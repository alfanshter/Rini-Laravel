@extends('layout.master')

@section('konten')
<h2>Pendaftaran</h2>
@if (session()->has('success'))
<div class="alert alert-success mt-2" role="alert">
    {{session('success')}}  
</div>
@endif

<form action="/ekskul/pendaftaran" method="POST">
  @csrf
  <input type="hidden" class="form-control" id="nim_siswa" name="nim_siswa" value="{{auth()->user()->nim}}">                   
  <input type="hidden" class="form-control" id="kode_ekskul" name="kode_ekskul" value="{{$data_ekskul->kode_ekskul}}">                   
  <input type="hidden" class="form-control" id="kode_pelatih" name="kode_pelatih" value="{{$data_ekskul->kode_pelatih}}">                   
  <input type="hidden" class="form-control" id="id_informasi" name="id_informasi" value="{{$data_ekskul->id}}">                   
  <input type="hidden" class="form-control" id="is_status" name="is_status" value="1">                   
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama:</label>
    <input type="text" class="form-control" id="nama" required disabled name="nama" value="{{old('nama',auth()->user()->name)}}">                   
  </select>
  </div>
  
  <div class="mb-3">
  <label for="recipient-name" class="col-form-label">Nama Ekstra:</label>
  <input type="text" class="form-control" id="nama" required disabled name="nama" value="{{$data_ekskul->nama}}">                   
</div>
<div class="mb-3">
  <label for="recipient-name" class="col-form-label">Pelatih:</label>
  <input type="text" class="form-control"  required disabled  value="{{$data_ekskul->name}}">                   
</div>

<div class="mb-3">
  <label for="recipient-name" class="col-form-label">Alasan:</label>
  <input type="text" class="form-control"  required  name="alasan" id="alasan"  value="{{$data_ekskul->alasan}}">                   

</div>


<div class="modal-footer">
  <a href="/informasiekskul"  class="btn btn-secondary" >Cancel</a>
  @if ($is_daftar ==1)
  <button type="button" class="btn btn-warning">Diseleksi</button>
  @endif
  @if ($is_daftar ==0)
  <button type="submit" class="btn btn-primary">Daftar</button>
  @endif
  @if ($is_daftar ==2)
  <button type="button" class="btn btn-warning">Sudah terdaftar</button>
  @endif
  @if ($is_daftar ==3)
  <button type="button" class="btn btn-danger">Ditolak</button>
  @endif

</div>
</form>

@endsection
