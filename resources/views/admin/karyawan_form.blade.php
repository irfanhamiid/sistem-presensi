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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ $action }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Karyawan</label>
                                <input type="text" class="form-control" name="nama" @if($btn == 'edit') value="{{ $data->nama }}" @endif id="" required placeholder="Masukkan Nama Karyawan">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" @if($btn == 'edit') value="{{ $data->email }}" @endif id="" required placeholder="Masukkan Email Karyawan">
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input type="text" class="form-control" name="no_telp" @if($btn == 'edit') value="{{ $data->no_telp }}" @endif id="" required placeholder="Masukkan Nomor Telepon">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" class="form-control" id="" cols="30" rows="5" placeholder="Masukkan alamat">@if($btn == 'edit'){{ $data->alamat }}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" @if($btn == 'edit' && $data->jenis_kelamin == "Laki-laki") selected @endif>Laki-laki</option>
                                    <option value="Perempuan" @if($btn == 'edit' && $data->jenis_kelamin == "Perempuan") selected @endif>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Agama</label>
                                <select name="agama" class="form-control" id="">
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" @if($btn == 'edit' && $data->agama == "Islam") selected @endif>Islam</option>
                                    <option value="Kristen" @if($btn == 'edit' && $data->agama == "Kristen") selected @endif>Kristen</option>
                                    <option value="Katolik" @if($btn == 'edit' && $data->agama == "Katolik") selected @endif>Katolik</option>
                                    <option value="Hindu" @if($btn == 'edit' && $data->agama == "Hindu") selected @endif>Hindu</option>
                                    <option value="Buddha" @if($btn == 'edit' && $data->agama == "Buddha") selected @endif>Buddha</option>
                                    <option value="Konghucu" @if($btn == 'edit' && $data->agama == "Konghucu") selected @endif>Konghucu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" id="" @if($btn == 'edit') value="{{ $data->tempat_lahir }}" @endif placeholder="Masukkan Tempat Lahir">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="" @if($btn == 'edit') value="{{ $data->tanggal_lahir }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" @if($btn == 'add') required @endif id="" placeholder="Masukkan Password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <a href="{{ route('karyawan-list') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
