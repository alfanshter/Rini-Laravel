<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Custom styles for this template -->

    <title>Document</title>
</head>
<style type="text/css">

div.absolute {
  position: absolute;
  right: 0;
}

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
    </style>
<body>
  @php
  setlocale(LC_TIME, 'id_ID');
  \Carbon\Carbon::setLocale('id');
@endphp

    <center>
        <div>
                <p style=" font-weight: bold;text-transform:uppercase">PROGRAM KEGIATAN EKSTRAKULIKULER {{$nama_ekskul}}</p>
                <p style=" font-weight: bold;text-transform:uppercase">SMA NEGERI 16 JAKARTA</p>
                <p style=" font-weight: bold;text-transform:uppercase">tahun pelajaran 2021/2022</p>
                {{-- <p style=" font-weight: bold;text-transform:uppercase">
                  BULAN : 
                  @foreach ($agenda as $data)
                  {{\Carbon\Carbon::parse($data->tanggal)->isoFormat('MMMM')}}
                  @endforeach
                  {{\Carbon\Carbon::parse($data->tanggal)->isoFormat('Y')}}
                  
                </p>                     --}}

        </div>
        <br>
    
    </center>
    
<table style="width:100%">
    <tr>
      <th>No</th>
      <th>HARI/TANGGAL</th> 
      <th>MATERI YANG DILAKSANAKAN</th>
    </tr>
    @foreach ($agenda as $data)
    <tr>
        <td >{{$loop->iteration}}</td>                                        
        <td >{{\Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y')}}</td>
        <td >{{$data->nama_materi}}</td>
    </tr>
        
    @endforeach
  </table>
  <br><br><br><br>
  
  <div id="flex" class="absolute">
    <table id="tabel1" style="border: 0ch" >
      <tr id="tabel1">
        <td id="tabel1">Jakarta  {{\Carbon\Carbon::now()->isoFormat('D MMMM Y')}}</td>
      </tr>
      <tr id="tabel1">
        <td id="tabel1">Pelatih Ekstrakulikuler</td>
      </tr>
      <br><br><br><br>
      <tr>
        <td id="tabel1" style="text-align: center">{{$nama_pelatih->nama_pelatih}}</td>
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