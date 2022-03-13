@extends('layout.master')

@section('konten')
<h2>Edit Informasi Ekskul</h2>
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

@error('nim')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror

@error('alamat')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror

@error('nohp')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror


<form action="/informasiekskul/updateinformasiekskul" method="POST">
  @csrf
  <input type="hidden" name="id" id="id" value="{{$data_ekskul->id}}">
<div class="mb-3">
  <label for="recipient-name" class="col-form-label">Nama:</label>
  <select class="form-control" aria-label="Default select example" name="kode_ekskul" id="kode_ekskul">
    <option value="{{$data_ekskul->kode_ekskul}}">{{$data_ekskul->nama}}</option>                                                
    @foreach ($ekskul as $data)
      <option value="{{$data->kode_ekskul}}">{{$data->nama}}</option>                                                
      @endforeach
  </select>
</div>
<div class="mb-3">
  <label for="recipient-name" class="col-form-label">Jadwal:</label>
  <select class="form-control" aria-label="Default select example" name="jadwal" id="jadwal">
      <option value="{{$data_ekskul->jadwal}}">{{$data_ekskul->jadwal}}</option>                                               
      <option value="Senin">Senin</option>                                                
      <option value="Selasa">Selasa</option>                                                
      <option value="Rabu">Rabu</option>                                                
      <option value="Kamis">Kamis</option>                                                
      <option value="Jumat">Jumat</option>                                                
      <option value="Sabtu">Sabtu</option>                                                
      <option value="Minggu">Minggu</option>                                                
  </select>
</div>
<div class="mb-3">
  <label for="recipient-name" class="col-form-label">Pukul:</label>
  <input type="time" class="form-control" id="jam" required name="jam" value="{{old('jam',$data_ekskul->jam)}}">
</div>

<div class="mb-3">
  <label for="message-text" class="col-form-label">Tempat:</label>
  <textarea class="form-control" id="tempat_ekskul" required name="tempat_ekskul" value="{{old('tempat_ekskul',$data_ekskul->tempat_ekskul)}}">{{old('tempat_ekskul', $data_ekskul->tempat_ekskul)}}</textarea>
</div>
<div class="mb-3">
  <label for="recipient-name" class="col-form-label">Pelatih:</label>
  <select class="form-control" aria-label="Default select example" name="kode_pelatih" id="kode_pelatih">
      <option value="{{$data_ekskul->nim}}">{{$data_ekskul->name}}</option>
      @foreach ($data_pelatih as $data)
      <option value="{{$data->nim}}">{{$data->name}}</option>                                                                                                
      @endforeach
  </select>

</div>

<div class="modal-footer">
  <a href="/informasiekskul" class="btn btn-secondary"> Cancel </a>
  <button type="submit" class="btn btn-primary">Edit</button>

</div>
</form>

@endsection
