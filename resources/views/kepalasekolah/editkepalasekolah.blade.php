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

@if (session()->has('success'))
<div class="alert alert-success mt-2" role="alert">
    {{session('success')}}  
</div>
@endif

@if (session()->has('failed'))
<div class="alert alert-danger mt-2" role="alert">
    {{session('failed')}}  
</div>
@endif


@error('nohp')
<div class="alert alert-danger mt-2" role="alert">
    {{$message}}  
</div>                        
@enderror

 @if (auth()->user()->role == 3)
    <form action="/kepalasekolah/updatekepalasekolah" method="POST">
 @else
    <form action="/kepalasekolah/updatekepalasekolah" method="POST">

    @endif

    @csrf
    <input type="hidden" name="id" id="id" value="{{$kepalasekolah->id}}">
    <input type="hidden" name="name" id="name" value="{{$kepalasekolah->name}}">
    <input type="hidden" name="nomor_induk" id="nomor_induk" value="{{$kepalasekolah->nomor_induk}}">
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama:</label>
    @if (auth()->user()->role == 3)
        <input  disabled type="text" class="form-control" id="name" name="name" value="{{old('name',$kepalasekolah->name)}}" >    
    @else 
        <input type="text" class="form-control" id="name" name="name" value="{{old('name',$kepalasekolah->name)}}">    
    @endif

  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Kode Kepala Sekolah:</label>
    @if (auth()->user()->role == 3)
        <input disabled type="text" class="form-control" id="nomor_induk" name="nomor_induk" value="{{old('nomor_induk',$kepalasekolah->nomor_induk)}}">
    @else 
        <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" value="{{old('nomor_induk',$kepalasekolah->nomor_induk)}}">
    @endif
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">No Hp:</label>
    @if (auth()->user()->role == 3)
        <input  type="number" class="form-control" id="nohp" name="nohp" value="{{old('nohp',$kepalasekolah->nohp)}}">
    @else 
        <input type="number" class="form-control" id="nohp" name="nohp" value="{{old('nohp',$kepalasekolah->nohp)}}">
    @endif

  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Username:</label>
    @if (auth()->user()->role == 3)
        <input  type="text" class="form-control" id="username" name="username" value="{{old('username',$kepalasekolah->username)}}">
    @else 
        <input type="text" class="form-control" id="username" name="username" value="{{old('username',$kepalasekolah->username)}}">
    @endif

  </div>

        <div class="mb-3">
         @if (auth()->user()->role == 3)
         <label for="recipient-name" class="col-form-label">Password Lama :</label>

            <input type="password"  class="form-control" id="password_lama" name="password_lama">
        @endif
    </div>

      <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Password:</label>
         @if (auth()->user()->role == 3)
            <input type="password"  class="form-control" id="password" name="password">
        @else 
            <input type="password" class="form-control" id="password" name="password">
        @endif
    </div>

    

  <div class="modal-footer">
    <a href="/kepalasekolah" class="btn btn-dark">Cancel</a>
    <button type="submit" class="btn btn-primary">Edit</button>

</div>
</form> 
@endsection
