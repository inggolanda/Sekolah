@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-7">
            <div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Ubah Data Siswa</h3>
								</div>
								<div class="panel-body">
                <form method="POST" action="/siswa/{{$Student->id}}/update" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                    <label for="namadepan">Nama Depan</label>
                    <input name="namadepan" type="text" class="form-control" id="namadepan" aria-describedby="emailHelp" placeholder="Nama Depan" value="{{$Student->nama_depan}}">
                  </div>
                  <div class="form-group">
                    <label for="namabelakang">Nama Belakang </label>
                    <input name="namabelakang" type="text" class="form-control" id="namabelakang" aria-describedby="emailHelp" placeholder="Nama Belakang" value="{{$Student->nama_belakang}}">
                  </div>
                  <div class="form-group">
                    <label for="level">Status</label>
                    <select name="level" class="form-control" id="level">
                      <option value="">Pilih Status</option>
                      <option value="Kepala Sekolah" @if($Student->level =='Kepala Sekolah') selected @endif >Kepala Sekolah</option>
                      <option value="Admin" @if($Student->level =='Admin') selected @endif>Admin</option>
                      <option value="Guru" @if($Student->level =='Guru') selected @endif>Guru</option>
                      <option value="Siswa" @if($Student->level =='Siswa') selected @endif>Siswa</option>
                    </select>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jeniskelamin" id="Laki-Laki" value="L" @if($Student->jenis_kelamin =='L') checked @endif>
                    <label class="form-check-label" for="Laki-Laki">Laki-Laki</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jeniskelamin" id="Perempuan" value="P" @if($Student->jenis_kelamin =='P') checked @endif>
                    <label class="form-check-label" for="Perempuan">Perempuan</label>
                  </div>
                  <div class="form-group">
                    <label for="agama">Agama</label>
                    <select name="agama" class="form-control" id="agama">
                      <option value="">Pilih Agama</option>
                      <option value="Islam" @if($Student->agama =='Islam') selected @endif >Islam</option>
                      <option value="Kristen" @if($Student->agama =='Kristen') selected @endif>Kristen</option>
                      <option value="Buddha" @if($Student->agama =='Buddha') selected @endif>Buddha</option>
                      <option value="Konghucu" @if($Student->agama =='Konghucu') selected @endif>Konghucu</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" id="Alamat" rows="3">{{$Student->alamat}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="Alamat">Avatar</label>
                    <input name="avatar" type="file" class="form-control">
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
                </div>
                </form>
								</div>
							</div>

            </div>
          </div>
      </div>
    </div>
</div>
@stop
@section('content1')
<div class="col-8 mt-3 ml-4">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status')}}
    </div>
    @endif
</div>
    <div class="card col-8 mt-3 ml-4">
        <div class="row">
            <div class="col-6 left">
                <h2 class="mt-3">Ubah Data Siswa</h2>
            </div>
        </div>
            <form method="POST" action="/siswa/{{$Student->id}}/update">
                @csrf
                  <div class="form-group">
                    <label for="namadepan">Nama Depan</label>
                    <input name="namadepan" type="text" class="form-control" id="namadepan" aria-describedby="emailHelp" placeholder="Nama Depan" value="{{$Student->nama_depan}}">
                  </div>
                  <div class="form-group">
                    <label for="namabelakang">Nama Belakang </label>
                    <input name="namabelakang" type="text" class="form-control" id="namabelakang" aria-describedby="emailHelp" placeholder="Nama Belakang" value="{{$Student->nama_belakang}}">
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jeniskelamin" id="Laki-Laki" value="L" @if($Student->jenis_kelamin =='L') checked @endif>
                    <label class="form-check-label" for="Laki-Laki">Laki-Laki</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jeniskelamin" id="Perempuan" value="P" @if($Student->jenis_kelamin =='P') checked @endif>
                    <label class="form-check-label" for="Perempuan">Perempuan</label>
                  </div>
                  <div class="form-group">
                    <label for="agama">Agama</label>
                    <select name="agama" class="form-control" id="agama">
                      <option value="">Pilih Agama</option>
                      <option value="Islam" @if($Student->agama =='Islam') selected @endif >Islam</option>
                      <option value="Kristen">Kristen</option>
                      <option value="Buddha">Buddha</option>
                      <option value="Konghucu">Konghucu</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" id="Alamat" rows="3">{{$Student->alamat}}</textarea>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
                </div>
                </form>
        </div>   
    </div>
    <!-- Modal Tambah Siswa -->
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
                </div>
            </div>
            </div>
@endsection
