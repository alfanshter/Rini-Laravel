@extends('layout.master')

@section('konten')
<h2>Edit Pengumuman</h2>

@error('file_pdf')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror
@error('keterangan')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror
@error('nama_pengumuman')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror

  <form action="/pengumuman/update" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="oldPdf" value="{{$pengumuman->file_pdf}}">
      <input type="hidden" name="id" id="id" value="{{$pengumuman->id}}">
      <div class="mb-3">
      <label for="recipient-name" class="col-form-label">Nama Pengumuman:</label>
      <input type="text" class="form-control" id="nama_pengumuman" required name="nama_pengumuman" value="{{old('nama_pengumuman',$pengumuman->nama_pengumuman)}}">
      </div>

      <div class="mb-3">
      <label for="recipient-name" class="col-form-label  d-block">Pdf sebelumnya:</label>
        @if ($pengumuman->file_pdf)
        <p id="file_pdf">{{$pengumuman->file_pdf}}</p>
        @else
        <img class="img-preview img-fluid">            
        @endif
      <input type="file" class="form-control" id="file_pdf"  name="file_pdf" value="{{old('file_pdf')}}" >
   
    </div>
      <div class="mb-3">
      <label for="recipient-name" class="col-form-label">Keterangan:</label>
      <input type="text" class="form-control" id="keterangan" required name="keterangan" value="{{old('keterangan',$pengumuman->keterangan)}}">
      </div>



      <div class="modal-footer">
      <a class="btn btn-secondary" href="/pengumuman">Kembali</a>
      <button type="submit" class="btn btn-primary">Edit</button>

      </div>
  </form>

@endsection