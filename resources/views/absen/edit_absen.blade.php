@extends('layout.master')

@section('konten')
<h2>Edit absen</h2>
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

<form action="/update_absen" method="POST">
  @csrf
  <input type="hidden" name="id" value="{{$absen->id}}" id="id">
  <input type="hidden" name="nama_ekskul" value="{{$absen->nama_ekskul}}" id="nama_ekskul">

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama Siswa:</label>
    <input type="text" class="form-control" disabled value="{{old('nama_siswa',$absen->nama_siswa)}}">                                      
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Semester:</label>
<select class="form-control" aria-label="Default select example" required name="semester" id="semester">
     <option value="{{$absen->semester}}">
                                                    {{$absen->semester}}
                                                </option>                                              
    <option value="GANJIL">
                                                    GANJIL
                                                </option>                                                
                                                <option value="GENAP">
                                                    GENAP
                                                </option>                                                

                                            </select>
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Tahun Ajaran:</label>
    <input type="text" class="form-control" id="tahun_ajaran"  required name="tahun_ajaran" value="{{old('tahun_ajaran',$absen->tahun_ajaran)}}">                                      
  </div>

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Absen:</label>
    <select class="form-control" aria-label="Default select example" name="absen" id="absen">
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
  <a href='/data_absen/{{$absen->nama_ekskul}}' class="btn btn-secondary" >Kembali</a>
  <button type="submit" class="btn btn-primary">Edit</button>

</div>
</form>


@endsection
