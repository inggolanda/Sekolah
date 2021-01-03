@extends('layouts.master')

@section('header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@stop

@section('content')
<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="{{$Student->getAvatar()}}" class="img-circle width=2px" alt="Avatar">
										<h3 class="name">{{$Student->nama_depan}}</h3>
										<span class="online-status status-available">Available</span>
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												{{$Student->mapel->count()}} <span>Mata Pelajaran</span>
											</div>
											<div class="col-md-4 stat-item">
												{{$Student->rataratanilai()}} <span>Rata-Rata Nilai</span>
											</div>
											<div class="col-md-4 stat-item">
												2174 <span>Points</span>
											</div>
										</div>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Data Diri</h4>
										<ul class="list-unstyled list-justify">
											<li>Nama Lengkap <span>{{$Student->nama_depan}} {{$Student->nama_belakang}}</span></li>
											<li>Jenis Kelamin<span>{{$Student->jenis_kelamin}}</span></li>
											<li>Agama<span>{{$Student->agama}}</span></li>
											<li>Alamat<span>{{$Student->alamat}}</span></li>
										</ul>
									</div>
								</div>
								<div class="text-center">
									<a href="/siswa/{{$Student->id}}/edit" class="btn btn-warning">Edit Profile</a>
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<div class="col-8 mt-3 ml-4">
									@if (session('status'))
									<div class="alert alert-success">
									{{ session('status')}}
									</div>
									@endif
									@if (session('tidakada'))
									<div class="alert alert-warning">
									{{ session('tidakada')}}
									</div>
									@endif
									@if (session('hapus'))
									<div class="alert alert-danger">
									{{ session('hapus')}}
									</div>
									@endif
									<!-- TABBED CONTENT -->
								<div class="custom-tabs-line tabs-line-bottom left-aligned">
									<ul class="nav" role="tablist">
										<!--<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Nilai</a></li>-->
										<li><button type="button" class="btn btn-default" data-toggle="modal" data-target="#Tambahnilai"><i class="fa fa-plus-square"></i>  Tambah Nilai</button></li>
									</ul>
								</div>
								<div class="tab-content mt-2">
									<div class="tab-pane fade in active" id="tab-bottom-left1">
										<!--<ul class="list-unstyled activity-timeline">
											<li>
												<i class="fa fa-comment activity-icon"></i>
												<p>Commented on post <a href="#">Prototyping</a> <span class="timestamp">2 minutes ago</span></p>
											</li>
											<li>
												<i class="fa fa-cloud-upload activity-icon"></i>
												<p>Uploaded new file <a href="#">Proposal.docx</a> to project <a href="#">New Year Campaign</a> <span class="timestamp">7 hours ago</span></p>
											</li>
											<li>
												<i class="fa fa-plus activity-icon"></i>
												<p>Added <a href="#">Martin</a> and <a href="#">3 others colleagues</a> to project repository <span class="timestamp">Yesterday</span></p>
											</li>
											<li>
												<i class="fa fa-check activity-icon"></i>
												<p>Finished 80% of all <a href="#">assigned tasks</a> <span class="timestamp">1 day ago</span></p>
											</li>
										</ul>
										<div class="margin-top-30 text-center"><a href="#" class="btn btn-default">See all activity</a></div>-->
										<table class="table table-condensed">
										<thead>
											<tr>
												<th>Kode</th>
												<th>Nama</th>
												<th>Semester</th>
												<th>Nilai</th>
												<th>Guru</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										@foreach($Student->mapel as $mapel)
											<tr>
												<td>{{$mapel->kode}}</td>
												<td>{{$mapel->nama}}</td>
												<td>{{$mapel->semester}}</td>
												<td> <a href="#" class="editnilai" data-type="text" data-pk="{{$mapel->id}}" data-url="/api/siswa/{{$Student->id}}/editnilai" data-title="Masukan Nilai">{{$mapel->pivot->nilai}}</a></td>
												<td><a href="/guru/{{$mapel->guru_id}}/Profile">{{$mapel->guru->nama}}</a></td>
												<td><a href="/siswa/{{$Student->id}}/{{$mapel->id}}/deletenilai" class="btn btn-danger" onclick=" return confrim('Apa Kamu Yakin ?')"><i class="fa fa-trash-o"></i>    Delete</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
									</div>
								</div>
								<!-- END TABBED CONTENT -->
								<hr class="mb-2"></hr>
								<div class="panel">
									<div id="chartnilai"></div>
								</div>
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>

		<!-- modal tambah nilai -->
		<div class="modal fade" id="Tambahnilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="/siswa/{{$Student->id}}/addnilai" enctype="multipart/form-data" >
        @csrf
		  <div class="form-group @error('matapelajaran') has-error @enderror">
            <label for="matapelajaran">Mata Pelajaran</label>
            <select name="matapelajaran" class="form-control" id="matapelajaran">
			  <option value="">Pilih Status</option>
			  @foreach($matapelajaran as $mapel)
			  <option value="{{$mapel->id}}">{{$mapel->nama}}</option>
			  @endforeach
            </select>
          </div>
          <div class="form-group @error('nilai') has-error @enderror">
            <label for="nilai">Nilai </label>
            <input name="nilai" type="text" class="form-control" id="nilai" aria-describedby="emailHelp" placeholder="Nilai Pelajaran" value="{{old('namabelakang')}}">
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
        </div>
    </div>
  </div>
@stop

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script>
Highcharts.chart('chartnilai', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Nilai'
    },
    subtitle: {
        text: 'Laporan Nilai Siswa'
    },
    xAxis: {
        //categories: {!!json_encode($categories)!!}
		//,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Nilai',
        //data: {!!json_encode($data)!!}

    }]
})

	$(document).ready(function() {
		$('.editnilai').editable();
	});
</script>
@stop