@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
            <div class="panel">
								<div class="panel-heading">
                  <h2 class="panel-title">Data Siswa</h2>
                    <div class="right">
                        <form action="/siswa/import" method="POST" enctype="multipart/form-data">
                          @csrf
                          <a href="/siswa/exportpdf" class="btn btn-sm btn-danger">PDF</a>
                          <input name="import" id="upload" class="hidden" type="file"/>
                          <a href="" id="action" class="btn btn-sm btn-success">Import</a>
                           <a href="" id="upload_link"><i class="lnr lnr-download"></i></a>
                          <button id="submit" type="submit" class="hidden"></button>

                          <a href="/siswa/export" class="btn btn-sm btn-primary">Excel</a>
                          <button type="button" class="btn" data-toggle="modal" data-target="#Tambahsiswa">
                          <i class="lnr lnr-plus-circle"></i>
                          </button>
                        </form>
                    </div>
								</div>
								<div class="panel-body">
                  <div class="col-8 mt-3 ml-4">
                    @if (session('status'))
                    <div class="alert alert-success">
                      {{ session('status')}}
                    </div>
                    @endif
                    @if (session('hapus'))
                    <div class="alert alert-danger">
                      {{ session('hapus')}}
                    </div>
                    @endif        
                  </div>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center" scope="col">No</th>
                          <th class="text-center" scope="col">Nama Depan</th>
                          <th class="text-center" scope="col">Nama Belakang</th>
                          <th class="text-center" scope="col">Jenis Kelamin</th>
                          <th class="text-center" scope="col">Agama</th>
                          <th class="text-center" scope="col">Alamat</th>
                          <th class="text-center" scope="col">Rata-Rata Nilai</th>
                          <th class="text-center" scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data_siswa as $siswa)
                            <tr>
                            <th class="text-center">{{ $loop->iteration }}</th>
                            <td class="text-center"><a href="/siswa/{{$siswa->id}}/profile">{{$siswa->nama_depan}}<a></td>
                            <td class="text-center"><a href="/siswa/{{$siswa->id}}/profile">{{$siswa->nama_belakang}}</a></td>
                            <td class="text-center" >{{$siswa->jenis_kelamin}}</td>
                            <td class="text-center">{{$siswa->agama}}</td>
                            <td>{{$siswa->alamat}}</td>
                            <td class="text-center" >{{$siswa->rataratanilai()}}</td>
                            <td>
                                <a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning"><i class="fa fa-warning"></i>       edite</a>
                                <a href="/siswa/{{$siswa->id}}/delete" class="btn btn-danger" onclick=" return confrim('Apa Kamu Yakin ?')"><i class="fa fa-trash-o"></i>    Delete</a>
                            </td>
                            </tr>
                            @endforeach
                      </tbody>
                    </table>
								</div>
							</div>
            </div>
          </div>
      </div>
    </div>
</div>

  <div class="modal fade" id="Tambahsiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{url('/siswa/create')}}" enctype="multipart/form-data" >
        @csrf
          <div class="form-group @error('namadepan') has-error @enderror">
            <label for="namadepan">Nama Depan</label>
            <input name="namadepan" type="text" class="form-control" id="namadepan" aria-describedby="emailHelp" placeholder="Nama Depan" value="{{old('namadepan')}}">
          </div>
          <div class="form-group @error('namabelakang') has-error @enderror">
            <label for="namabelakang">Nama Belakang </label>
            <input name="namabelakang" type="text" class="form-control" id="namabelakang" aria-describedby="emailHelp" placeholder="Nama Belakang" value="{{old('namabelakang')}}">
          </div>
          <div class="form-group @error('level') has-error @enderror">
            <label for="level">Status</label>
            <select name="level" class="form-control" id="level">
              <option value="">Pilih Status</option>
              <option value="Kepala Sekolah">Kepala Sekolah</option>
              <option value="Admin">Admin</option>
              <option value="Guru">Guru</option>
              <option value="Siswa">Siswa</option>
            </select>
          </div>
          <div class="form-group @error('email') has-error @enderror">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="email">
          </div>
          <div class="form-check form-check-inline @error('jeniskelamin') has-error @enderror">
            <input class="form-check-input" type="radio" name="jeniskelamin" id="Laki-Laki" value="L">
            <label class="form-check-label" for="Laki-Laki">Laki-Laki</label>
          </div>
          <div class="form-check form-check-inline @error('jeniskelamin') has-error @enderror ">
            <input class="form-check-input" type="radio" name="jeniskelamin" id="Perempuan" value="P">
            <label class="form-check-label" for="Perempuan">Perempuan</label>
          </div>
          <div class="form-group @error('agama') has-error @enderror">
            <label for="agama">Agama</label>
            <select name="agama" class="form-control" id="agama">
              <option value="">Pilih Agama</option>
              <option value="Islam">Islam</option>
              <option value="Kristen">Kristen</option>
              <option value="Buddha">Buddha</option>
              <option value="Konghucu">Konghucu</option>
            </select>
          </div>
          <div class="form-group @error('alamat') has-error @enderror">
            <label for="Alamat">Alamat</label>
            <textarea name="alamat" class="form-control" id="Alamat" rows="3"></textarea>
          </div>
          <div class="form-group @error('avatar') has-error @enderror">
            <label for="Alamat">Avatar</label>
            <input name="avatar" type="file" class="form-control">
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
        </div>
    </div>
  </div>
@stop

@section('footer')
<script>
$(function(){
$("#upload_link").on('click', function(e){
    e.preventDefault();
    $("#upload:hidden").trigger('click');
});
});

$("#action").on('click', function(a){
    a.preventDefault();
    $("#submit:hidden").trigger('click');
});
</script>
@stop