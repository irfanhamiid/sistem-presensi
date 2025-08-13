@extends('layouts.app')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Jam Kerja</h4>
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
                    <a href="#">Jam Kerja</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('jam-kerja-update',$data->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Jam Masuk</label>
                                <input type="time" class="form-control" name="jam_masuk" value="{{ $data->jam_masuk }}" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Jam Pulang</label>
                                <input type="time" class="form-control" name="jam_pulang" value="{{ $data->jam_pulang }}" id="">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
