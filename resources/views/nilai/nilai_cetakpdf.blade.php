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
                <p style=" font-weight: bold;text-transform:uppercase">SMA NEGERI 16 JAKARTA</p>
                <p style=" font-weight: bold;text-transform:uppercase">DAFTAR NILAI PESERTA EKSTRAKULIKULER {{$nilai[0]->nama_ekskul}}</p>
                <p style=" font-weight: bold;text-transform:uppercase">semester {{$nilai[0]->semester}} </p>
                <p style=" font-weight: bold;text-transform:uppercase">tahun pelajaran {{$nilai[0]->tahun_ajaran}}</p>
        </div>
        <br>
    
    </center>
    
<table style="width:100%">
    <tr>
      <th>No</th>
      <th>Nama</th> 
      <th>Kelas</th>
      <th>Nilai</th>
      <th>Predikat</th>
    </tr>
    @foreach ($nilai as $data)
    <tr>
        <td class="center" >{{$loop->iteration}}</td>                                        
        <td class="center">{{$data->nama_siswa}}</td>                                        
        <td class="center">{{$data->kelas}}</td>
        <td class="center">{{$data->nilai}}</td>
        <td class="center" >
          @if ($data->nilai>=92)
          A
          @endif

          @if ($data->nilai>=80 && $data->nilai<=91)
              B
          @endif

          @if ($data->nilai<80)
              C
          @endif
          
        </td>
    </tr>
        
    @endforeach
  </table>
  <br><br><br><br>

  <div id="flex" class="absolute">
    <table id="tabel1" style="border: 0ch">
      <tr id="tabel1">
        <td id="tabel1">Jakarta  {{\Carbon\Carbon::now()->isoFormat('D MMMM Y')}}</td>
      </tr>
      <tr>
        <td id="tabel1">Pelatih Ekstrakulikuler</td>
      </tr>
      <br><br><br><br>
      <tr>
        <td id="tabel1" style="text-align: center">{{$nilai[0]->nama_pelatih}}</td>
      </tr>
    </table>
  
  </div>


</body>
</html>