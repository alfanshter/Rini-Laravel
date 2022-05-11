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

<form action="/update_prestasi" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$data_prestasi->id}}" id="id">
    <input type="hidden" name="kode_ekskul" value="{{$data_prestasi->kode_ekskul}}" id="kode_ekskul">
     <input type="hidden" name="oldImage" value="{{$data_prestasi->foto}}">
    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Nama Peserta:</label>
        <input type="text" class="form-control" disabled value="{{old('nama_peserta',$data_prestasi->user->name)}}">
    </div>

    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Nama Ekskul:</label>
        <input type="text" class="form-control" disabled value="{{old('nama_ekskuls',$data_prestasi->ekskul->nama)}}">
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

    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Foto:</label><br>
        <center>
            <img class="img-preview" src="{{asset('storage/'. $data_prestasi->foto)}}" width="150" height="150" alt="" srcset="">

            <label for="foto" class="d-block btn mt-4" style="width: 200px;background-color:#FA610B; color:black">Pilih Foto</label>
            <input type="file" name="foto" class="btn btn-primary" id="foto" style="visibility: hidden" onchange="previewImage()"><br><br>
            <script>
                function previewImage() {
                    const image =
                        document.querySelector(
                            "#foto"
                        );
                    const imgPreview =
                        document.querySelector(
                            ".img-preview"
                        );

                    imgPreview.style.display =
                        "block";

                    const oFReader =
                        new FileReader();
                    oFReader.readAsDataURL(
                        foto.files[0]
                    );

                    oFReader.onload = function(
                        oFREvent
                    ) {
                        imgPreview.src =
                            oFREvent.target.result;
                    };
                }
            </script>
        </center>
    </div>


    <div class="modal-footer">
        <a href='/daftar_prestasi/{{$data_prestasi->ekskul->kode}}' class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Edit</button>

    </div>
</form>


@endsection