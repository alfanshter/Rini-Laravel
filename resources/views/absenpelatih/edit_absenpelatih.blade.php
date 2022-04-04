@extends('layout.master')

@section('konten')
<h2>Edit absen</h2>

@if (session()->has('success'))
<div class="alert alert-success mt-2" role="alert">
    {{session('success')}}  
</div>
@endif

<form action="/update_absenpelatih" method="POST">
  @csrf
  <input type="hidden" name="id" value="{{$absen->id}}" id="id">

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama Pelatih:</label>
    <input type="text" class="form-control" disabled value="{{old('nama_siswa',$absen->name)}}">                                      
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Semester:</label>
    <input type="text" class="form-control" disabled value="{{old('semester',$absen->semester)}}">                                      
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Tahun Ajaran:</label>
    <input type="text" class="form-control" id="tahun_ajaran" disabled required name="tahun_ajaran" value="{{old('tahun_ajaran',$absen->tahun_ajaran)}}">                                      
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Absen:</label>
    <select class="form-control" aria-label="Default select example" name="absen" id="absen">
      <option value="{{$absen->absen}}">
        @if ($absen->absen == 1)
            Hadir
        @endif
        @if ($absen->absen == 2)
        Alfa
        @endif
        @if ($absen->absen == 3)
        Ijin
        @endif
        @if ($absen->absen == 4)
        Sakit
        @endif



    </option>    
      <option value="2">
          Alfa
      </option>                                                
      <option value="3">
          Ijin
      </option>                                               
      <option value="4">
          Sakit
      </option>                                                
      <option value="1">
          Hadir
      </option>            
    </select>
</div>

  <div class="modal-footer">
  <a href='/data_absenpelatih/{{$absen->nama_ekskul}}' class="btn btn-secondary" >Kembali</a>
  <button type="submit" class="btn btn-primary">Edit</button>

</div>
</form>


@endsection
