@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
        <div class="panel panel-profile ">
            <div class="row">
                <div class="col-md-6">
                <div class="panel panel-profile-detail">
                    <div class="panel-heading mt-2">
                        <h2 class="panel-title">Rank</h2>
                    </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Nama Lengkap</th>
                                    <th class="text-center" scope="col">Nilai</th>
                                </tr>
                                </thead>
                                    <tbody>
                                        @foreach(rangking() as $s)
                                        <tr>
                                            <td class="text-center" >{{ $loop->iteration }}</td>
                                            <td class="text-center" >{{ $s->namalengkap()}}</td>
                                            <td class="text-center" >{{ $s->rataratanilai}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="lnr lnr-user"></i></span>
                        <p>
                            <span class="number">{{totalsiswa()}}</span>
                            <span class="title">Siswa</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="lnr lnr-user"></i></span>
                        <p>
                            <span class="number">{{totalguru()}}</span>
                            <span class="title">guru</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@stop