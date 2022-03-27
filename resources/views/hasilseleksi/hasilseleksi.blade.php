@extends('layout.master')


@section('konten')

    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Hasil Seleksi</h1>
                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2" role="alert">
                            {{session('success')}}  
                        </div>
                    @endif

                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data  Hasil Seleksi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>NISN</th>
                                            <th>Nama Ekskul</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    @if (auth()->user()->role ==1)
                                    <tbody>
                                        @foreach ($hasil_seleksi as $data)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>                                        
                                                <td>{{$data->name}}</td>                                        
                                                <td>{{$data->kelas}}</td>                                        
                                                <td>{{$data->nim}}</td>                                        
                                                <td>{{$data->nama}}</td> 
                                                @if ($data->is_status ==2)
                                                <td>Diterima</td>                                       
                                                @endif
                                                @if ($data->is_status ==3)
                                                <td>Ditolak</td>                                       
                                                @endif
                                                @if ($data->is_status ==1)
                                                <td>Dalam Seleksi</td>                                       
                                                @endif
                                            </tr>
                                        @endforeach
                                                
                                    </tbody>
                                    
                                    @endif

                                    @if (auth()->user()->role ==0)
                                    <tbody>
                                        @foreach ($hasil_seleksi as $data)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>                                        
                                                <td>{{$data->name}}</td>                                        
                                                <td>{{$data->kelas}}</td>                                        
                                                <td>{{$data->nim}}</td>                                        
                                                <td>{{$data->nama}}</td> 
                                                @if ($data->is_status ==2)
                                                <td>Diterima</td>                                       
                                                @endif
                                                @if ($data->is_status ==3)
                                                <td>Ditolak</td>                                       
                                                @endif
                                                @if ($data->is_status ==1)
                                                <td>Dalam Seleksi</td>                                       
                                                @endif
                                            </tr>
                                        @endforeach
                                                
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

@endsection