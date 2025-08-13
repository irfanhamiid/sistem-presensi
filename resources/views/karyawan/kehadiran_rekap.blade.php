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
                    <div class="card-header">
                        <form action="{{ route('rekap-kehadiran-filter') }}" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control" id="daterangepicker" name="tanggal">
                            </div>
                            <div class="col-4">
                                <select name="tipe" id="" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="masuk" @if ($btn == 'filter' && $filter['tipe'] == 'masuk') selected @endif>Masuk</option>
                                    <option value="keluar" @if ($btn == 'filter' && $filter['tipe'] == 'keluar') selected @endif>Keluar</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Cari</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="cek" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Waktu</th>
                                        <th>Lokasi</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->waktu)->translatedFormat('l, d F Y H:i:s') }}</td>
                                            <td>{{ $data->lokasi }}</td>
                                            <td>{{ $data->tipe }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td><a href="{{ asset('presensi/'.$data->gambar) }}" target="_blank"><img src="{{ asset('presensi/'.$data->gambar) }}" style="max-width: 200px" alt=""></a></td>
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
