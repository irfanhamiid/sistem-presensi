@extends('layouts.app')
@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                    <h5 class="text-white op-7 mb-2"></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Karyawan</p>
                                    <h4 class="card-title">{{ $karyawan }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Presensi Kehadiran Bulan
                            {{ \Carbon\Carbon::parse('F')->translatedFormat('F Y') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">Masuk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Pulang</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <a href="{{ route('laporan-kehadiran-cetak','masuk') }}" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></a>
                                <div class="table-responsive mt-3">
                                    <table id="cek" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Waktu</th>
                                                <th>Jenis Presensi</th>
                                                <th>Lokasi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no=1;
                                            @endphp
                                            @foreach($masuk as $masuk)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $masuk->nama }}</td>
                                                <td>{{ \Carbon\Carbon::parse($masuk->waktu)->translatedFormat('l, d F Y H:i:s') }}</td>
                                                <td>{{ $masuk->tipe }}</td>
                                                <td>{{ $masuk->lokasi }}</td>
                                                <td>{{ $masuk->status }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <a href="{{ route('laporan-kehadiran-cetak','keluar') }}" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></a>
                                <div class="table-responsive mt-3">
                                    <table id="ceks" class="display table table-striped table-hover">
                                       <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Waktu</th>
                                                <th>Jenis Presensi</th>
                                                <th>Lokasi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no=1;
                                            @endphp
                                            @foreach($pulang as $pulang)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $pulang->nama }}</td>
                                                <td>{{ \Carbon\Carbon::parse($pulang->waktu)->translatedFormat('l, d F Y H:i:s') }}</td>
                                                <td>{{ $pulang->tipe }}</td>
                                                <td>{{ $pulang->lokasi }}</td>
                                                <td>{{ $pulang->status }}</td>
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
    </div>
@endsection
