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
										<img src="" class="img-circle width=2px" alt="Avatar">
										<h3 class="name">{{$guru->nama}}</h3>
										<span class="online-status status-available">Available</span>
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												{{$guru->mapel->count()}} <span>Mata Pelajaran</span>
											</div>
											<div class="col-md-4 stat-item">
												15 <span>Awards</span>
											</div>
											<div class="col-md-4 stat-item">
												2174 <span>Points</span>
											</div>
										</div>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
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
										<table class="table table-condensed">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Semester</th>
											</tr>
										</thead>
										<tbody>
										@foreach($guru->mapel as $mapel)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{$mapel->nama}}</td>
												<td>{{$mapel->semester}}</td>
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
@stop
