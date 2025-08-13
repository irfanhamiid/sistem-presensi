@extends('layouts.app')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Profile</h4>
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
                    <a href="#">Profile</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('karyawan-profile-update',$data->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $data->email }}" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input type="text" class="form-control" name="no_telp" value="{{ $data->no_telp }}" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="" class="form-control" cols="30" rows="3">{{ $data->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" value="{{ $data->tempat_lahir }}" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Tangal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" id="" placeholder="Kosongkan jika tidak diubah">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Simpan</button>
                                <a href="{{ route('karyawan-dashboard') }}" class="btn btn-primary btn-border">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
