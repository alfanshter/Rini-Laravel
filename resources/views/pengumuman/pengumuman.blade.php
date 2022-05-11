@extends('layout.master')


@section('konten')

    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Pengumuman</h1>
                    @if (auth()->user()->role ==0)
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#tambahpengumuman">Tambah Pengumuman</button>                        
                      <!-- Pengumuman Modal-->
                      <div class="modal fade" id="tambahpengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman?</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <form action="/pengumuman" method="POST" enctype="multipart/form-data">
                                      @csrf
                                    <div class="mb-3">
                                      <label for="recipient-name" class="col-form-label">Nama Pengumuman:</label>
                                      <input type="text" class="form-control" id="nama_pengumuman" name="nama_pengumuman" required value="{{old('nama_pengumuman')}}">
                                    </div>
                                    <div class="mb-3">
                                      <label for="recipient-name" class="col-form-label">Keterangan:</label>
                                      <input type="text" class="form-control" id="keterangan" name="keterangan" required value="{{old('keterangan')}}">
                                    </div>
                                    <div class="mb-3">
                                      <label for="recipient-name" class="col-form-label">File PDF:</label>
                                      <input type="file" class="form-control" id="file_pdf" name="file_pdf" required value="{{old('file_pdf')}}">
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                      <button type="submit" class="btn btn-primary">Tambah</button>
  
                                  </div>
                                  </form>
                                </div>
                              

                          </div>
                      </div>
                  </div>

                    @endif

                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2" role="alert">
                            {{session('success')}}  
                        </div>
                    @endif

                    @error('file_pdf')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror

                    @error('nama_pengumuman')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror

                    @error('keterangan')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}  
                    </div>                        
                    @enderror
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data  Pengumuman</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Keterangan</th>
                                            <th>Nama</th>
                                            <th>Pdf</th>
                                            @if (auth()->user()->role ==0)
                                            <th>Action</th>                                                
                                            @endif
                                        </tr>
                                    </thead>
                                    @if (auth()->user()->role ==0)
                                    <tbody>
                                        @foreach ($pengumuman as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->keterangan}}</td>
                                            <td>{{$data->nama_pengumuman}}</td>
                                            <td><a href="{{asset('storage/'.$data->file_pdf)}}" download="{{$data->file_pdf}}">
                                                <p>Download Pdf</p>
                                              </a>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-sm-center mt-2">
                                                
                                                    <a href="pengumuman/{{$data->id}}" class="btn btn-warning">Edit</a>

                                                    <form action="/pengumuman/delete" method="post">
                                                        @csrf
                                                        <input type="hidden" name="file_pdf" value="{{$data->file_pdf}}" id="file_pdf">
                                                        <input type="hidden" name="id" value="{{$data->id}}" id="id">
                                                        <button class="btn btn-danger ml-2" onclick="return confirm('Apakah anda akan menghapus data ?')">Hapus</button>
                                                    </form>

                                                </div>
                                                </td>                                        

                                        </tr>                                            
                                        @endforeach
                                    </tbody>
                                    @endif

                                    @if (auth()->user()->role ==1)
                                    <tbody>
                                        @foreach ($pengumuman as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->keterangan}}</td>
                                            <td>{{$data->nama_pengumuman}}</td>
                                            <td><a href="{{asset('storage/'.$data->file_pdf)}}" download="{{$data->file_pdf}}">
                                                <p>Download Pdf</p>
                                              </a>
                                            </td>
                                        </tr>                                            
                                        @endforeach
                                    </tbody>
                                    @endif

                                    @if (auth()->user()->role ==2)
                                    <tbody>
                                        @foreach ($pengumuman as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->keterangan}}</td>
                                            <td>{{$data->nama_pengumuman}}</td>
                                            <td><a href="{{asset('storage/'.$data->file_pdf)}}" download="{{$data->file_pdf}}">
                                                <p>Download Pdf</p>
                                              </a>
                                            </td>
                                        </tr>                                            
                                        @endforeach
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

@endsection