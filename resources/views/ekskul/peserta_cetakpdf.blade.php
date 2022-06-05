<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Custom styles for this template -->

    <title>Document</title>
</head>
<style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    </style>
<body>
    
    <center>
        <div>
                <p style=" font-weight: bold;">DAFTAR PESERTA</p>
                <p style=" font-weight: bold;text-transform:uppercase">EKSTRAKURIKULER {{$peserta[0]->nama}}</p>
             
        </div>
        <br>
    
    </center>
    
<table style="width:100%">
    <tr>
      <th>No</th>
      <th>Nama</th> 
      <th>Kelas</th>
    </tr>
    @foreach ($peserta as $data)
    <tr>
        <td >{{$loop->iteration}}</td>                                        
        <td >{{$data->name}}</td>
        <td >{{$data->kelas}}</td>
    </tr>
        
    @endforeach
  </table>
</body>
</html>