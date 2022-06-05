@extends('layout.master')

@section('konten')
<h2>Edit Wali Kelas</h2>
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

@if (auth()->user()->role == 4)
    <form action="/walikelas/updatewalikelas" method="POST">
 @else
    <form action="/walikelas/updatewalikelas" method="POST">
  @endif
      @csrf
    <input type="hidden" name="id" id="id" value="{{$walikelas->id}}">
        <input type="hidden" name="name" id="name" value="{{$walikelas->name}}">
    <input type="hidden" name="nomor_induk" id="nomor_induk" value="{{$walikelas->nomor_induk}}">

  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Nama:</label>
    @if (auth()->user()->role == 4)
        <input  disabled type="text" class="form-control" id="name" name="name" value="{{old('name',$walikelas->name)}}" >    
    @else 
        <input   type="text" class="form-control" id="name" name="name" value="{{old('name',$walikelas->name)}}">    
    @endif
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Kode Wali Kelas:</label>
    @if (auth()->user()->role == 4)
        <input disabled type="text" class="form-control" id="nomor_induk" name="nomor_induk" value="{{old('nomor_induk',$walikelas->nomor_induk)}}">
    @else 
        <input  type="text" class="form-control" id="nomor_induk" name="nomor_induk" value="{{old('nomor_induk',$walikelas->nomor_induk)}}">
    @endif
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">No Hp:</label>
    @if (auth()->user()->role == 4)
        <input type="number" class="form-control" id="nohp" name="nohp"  value="{{old('nohp',$walikelas->nohp)}}">
    @else 
        <input type="number" class="form-control" id="nohp" name="nohp" value="{{old('nohp',$walikelas->nohp)}}">
    @endif
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Username:</label>
     @if (auth()->user()->role == 4)
        <input type="text"  class="form-control" id="username" name="username" value="{{old('username',$walikelas->username)}}">
    @else 
        <input type="text" class="form-control" id="username" name="username" value="{{old('username',$walikelas->username)}}">
    @endif
  </div>

    <div class="mb-3">
         @if (auth()->user()->role == 4)
         <label for="recipient-name" class="col-form-label">Password Lama :</label>
            <input type="password"  class="form-control" id="password_lama" name="password_lama">
        @endif
    </div>

      <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Password:</label>
         @if (auth()->user()->role == 4)
            <input type="password"  class="form-control" id="password" name="password">
        @else 
            <input type="password" class="form-control" id="password" name="password">
        @endif
    </div>

  <div class="modal-footer">
    <a href="/walikelas" class="btn btn-dark">Cancel</a>
    <button type="submit" class="btn btn-primary">Edit</button>

</div>
</form> 
@endsection
