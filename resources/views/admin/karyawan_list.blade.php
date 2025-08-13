@extends('layouts.app')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Karyawan</h4>
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
                    <a href="#">Karyawan</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-icon btn-round btn-primary"
                            onclick="window.location='{{ route('karyawan-create') }}'">
                            <i class="fas fa-plus"></i>
                        </button>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor Telepon</th>
                                        <th>Alamat</th>
                                        <th>Total Absensi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
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
        var table = $("#basic-datatables").DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: "{{ route('karyawan-data') }}",
            columns: [{
                    "data": "DT_RowIndex"
                },
                {
                    "data": "nama"
                },
                {
                    "data": "email"
                },
                {
                    "data": "no_telp"
                },
                {
                    "data": "alamat"
                },
                {
                    "data": "jumlah"
                },
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                },

            ],
        });
    </script>
@endsection
