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
                                    @foreach ($data as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="">Tipe Presensi</label>
                                <select name="tipe" id="" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="masuk">Masuk</option>
                                    <option value="keluar">Keluar</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="" style="color: white"></label>
                                <button type="submit" class="btn btn-primary btn-block">Cari</button>
                            </div>
                        </div>
                    </form>
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
