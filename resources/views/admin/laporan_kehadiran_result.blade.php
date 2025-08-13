@extends('layouts.app')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Rekap Kehadiran</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Data</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Rekap Kehadiran</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('laporan-kehadiran-filter') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Tanggal</label>
                                    <input type="text" class="form-control" id="daterangepicker" name="tanggal">
                                </div>
                                <div class="col-3">
                                    <label for="">Karyawan</label>
                                    <select name="karyawan" class="form-control" id="">
                                        <option value="">Semua Karyawan</option>
                                        @foreach ($filter['data_karyawan'] as $data_karyawan)
                                            <option value="{{ $data_karyawan->id }}"
                                                @if ($btn == 'filter' && $filter['karyawan'] == $data_karyawan->id) selected @endif>{{ $data_karyawan->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="">Jenis Presensi</label>
                                    <select name="tipe" id="" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="masuk" @if ($btn == 'filter' && $filter['tipe'] == 'masuk') selected @endif>Masuk
                                        </option>
                                        <option value="keluar" @if ($btn == 'filter' && $filter['tipe'] == 'keluar') selected @endif>Keluar
                                        </option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="" style="color: white"></label>
                                    <button type="submit" class="btn btn-primary btn-block">Cari</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12 mt-2">
                                <form action="{{ route('laporan-kehadiran-cetaks') }}" method="POST" target="_blank">
                                    @csrf
                                    <input type="hidden" name="tanggal" value="{{ $filter['tanggal'] }}">
                                    <input type="hidden" name="karyawan" value="{{ $filter['karyawan'] }}">
                                    <input type="hidden" name="tipe" value="{{ $filter['tipe'] }}">
                                    <button type="submit" class="btn btn-success">Cetak PDF</button>
                                </form>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-3 mt-2">
                                <a href="{{ route('laporan-kehadiran-excel',['mulai_tanggal' => $filter['mulai_tanggal'],'sampai_tanggal' => $filter['sampai_tanggal'],'tipe'=>$filter['tipe'],'karyawan'=>$filter['karyawan']]) }}" class="btn btn-sm btn-success btn-block"><i class="fa fa-file-excel"></i>
                                    Export Excel</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table id="cek" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Waktu</th>
                                    <th>Jenis Presensi</th>
                                    <th>Lokasi</th>
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
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->waktu)->translatedFormat('l, d F Y H:i:s') }}
                                        </td>
                                        <td>{{ $data->tipe }}</td>
                                        <td>{{ $data->lokasi }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td><a href="{{ asset('presensi/' . $data->gambar) }}" target="_blank"><img
                                                    src="{{ asset('presensi/' . $data->gambar) }}" alt=""
                                                    style="max-width: 200px"></a></td>
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
        $('#daterangepicker').daterangepicker({
            locale: {
                'format': 'YYYY-MM-DD',
            },
            ranges: {
                'Hari Ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                    .endOf('month')
                ]
            }
        });
    </script>
@endsection
