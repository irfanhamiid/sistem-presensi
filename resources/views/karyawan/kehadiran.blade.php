@extends('layouts.app')
@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Presensi Kehadiran</h2>
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
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Presensi</p>
                                    @php
                                        $idKaryawan = Auth::user()->id_karyawan;
                                        $tanggalHariIni = date('Y-m-d');

                                        $masuk = DB::table('absensis')
                                            ->where('id_karyawan', $idKaryawan)
                                            ->whereDate('waktu', $tanggalHariIni)
                                            ->where('tipe', 'masuk')
                                            ->exists();

                                        $keluar = DB::table('absensis')
                                            ->where('id_karyawan', $idKaryawan)
                                            ->whereDate('waktu', $tanggalHariIni)
                                            ->where('tipe', 'keluar')
                                            ->exists();
                                    @endphp

                                    @if (!$masuk)
                                        <a href="{{ route('presensi-form', ['status' => 'masuk']) }}"
                                            class="btn btn-primary">Presensi Masuk</a>
                                    @elseif($masuk && !$keluar)
                                        <a href="{{ route('presensi-form', ['status' => 'keluar']) }}"
                                            class="btn btn-success">Presensi Keluar</a>
                                    @else
                                        <h4 class="card-title">Terima kasih sudah melakukan presensi</h4>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Tanggal</p>
                                    <h4 class="card-title">
                                        {{ \Carbon\Carbon::parse(date('d F Y'))->translatedFormat('l, d F Y') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Waktu</p>
                                    <h4 class="card-title" id="jam"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Presensi Hari Ini</h3>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="cek" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Waktu</th>
                                    <th>Lokasi</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Gambar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->waktu)->translatedFormat('l, d F Y H:i:s') }}</td>
                                        <td>{{ $data->lokasi }}</td>
                                        <td>{{ $data->tipe }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td><a href="{{ asset('presensi/' . $data->gambar) }}" target="_blank"><img
                                                    src="{{ asset('presensi/' . $data->gambar) }}" style="max-width: 200px"
                                                    alt=""></a></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        function updateJam() {
            const now = new Date();
            const jam = now.getHours().toString().padStart(2, '0');
            const menit = now.getMinutes().toString().padStart(2, '0');
            const detik = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('jam').textContent = `${jam}:${menit}:${detik}`;
        }

        setInterval(updateJam, 1000); // Update setiap 1 detik
        updateJam();
    </script>
@endsection
