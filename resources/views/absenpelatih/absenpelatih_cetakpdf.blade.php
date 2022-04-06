<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Custom styles for this template -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <title>Document</title>
</head>
<style type="text/css">

    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    #tabel1 {
      border: 0px solid black;
      border-collapse: collapse;
}
  
   #flex {
     display: inline-flex;
   }

   div.absolute {
  position: absolute;
  right: 0;
}

    .flex-container {
  display: flex;
  background-color: DodgerBlue;
}

.flex-container > div {
  background-color: #f1f1f1;
  margin: 10px;
  padding: 20px;
  font-size: 30px;
}

div.absolute {
  position: absolute;
  right: 0;
}

td.center {
  position: absolute;
  text-align: center;
}
    </style>
<body>
  @php
  setlocale(LC_TIME, 'id_ID');
  \Carbon\Carbon::setLocale('id');
@endphp

    <center>
        <div>
                <p style=" font-weight: bold;text-transform:uppercase">DAFTAR HADIR PESERTA KEGIATAN EKTRAKULIKULER {{$nama_ekskul}}</p>
                <p style=" font-weight: bold;text-transform:uppercase">SMA NEGERI 16 JAKARTA</p>
                <p style=" font-weight: bold;text-transform:uppercase">tahun pelajaran {{$tahun_ajaran}}</p>
        </div>
        <br>
    
    </center>
    

    
<table style="width: 100%">
  <thead>
      <tr>
          <th scope="col">No</th>
          <th scope="col">Nama Pelatih</th>
          <th scope="col">Ekstrakulikuler</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Keterangan</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($datapelatih->absensi_pelatih()->where('tahun_ajaran',$tahun_ajaran)->where('semester',$semester)->get() as $i)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $namapelatih }}</td>
        <td>{{ $nama_ekskul }}</td>
        <td>{{ $i->tanggal }}</td>
        @if ($i->absen == 1)
        <td>Masuk</td>                                                
        @endif
        @if ($i->absen == 2)
        <td>A</td>                                                
        @endif
        @if ($i->absen == 3)
        <td>Ijin</td>                                                
        @endif
        @if ($i->absen == 4)
        <td>Sakit</td>                                                
        @endif
    
    </tr>

    @endforeach

  </tbody>
</table>
<br><br><br><br>


<div id="flex" class="absolute">
  <table id="tabel1" style="border: 0ch">
    <tr id="tabel1">
      <td id="tabel1">Jakarta  {{\Carbon\Carbon::now()->isoFormat('D MMMM Y')}}</td>
    </tr>
    <tr id="tabel1">
      <td id="tabel1">Pelatih Ekstrakulikuler</td>
    </tr>
    <br><br><br><br>
    <tr>
      <td id="tabel1" style="text-align: center">{{$namapelatih}}</td>
    </tr>
  </table>

</div>

{{-- <div id="flex" style="margin-left: 200px">
  <table id="tabel1" style="border: 0ch">
    <tr id="tabel1">
      <td id="tabel1">Jakarta  {{\Carbon\Carbon::now()->isoFormat('D MMMM Y')}}</td>
    </tr>
    <tr>
      <td id="tabel1">Ketua Ekstrakulikuler</td>
    </tr>
    <br><br><br><br>
    <tr>
      <td id="tabel1" style="text-align: center">Husnul Khotimah</td>
    </tr>
  </table>

</div>

<div id="flex" style="margin-left: 180px">
  <table id="tabel1" style="border: 0ch">
    <tr id="tabel1">
      <td id="tabel1">Mengetahui,</td>
    </tr>
    <tr>
      <td id="tabel1">Pembina Ektrakulikuler</td>
    </tr>
    <br><br><br><br>
    <tr>
      <td id="tabel1" style="text-align: center">Dra. Rini</td>
    </tr>
    <tr>
      <td id="tabel1" style="text-align: center">NIP.196612071993032007</td>
    </tr>

  </table>

</div> --}}



</body>
</html>


