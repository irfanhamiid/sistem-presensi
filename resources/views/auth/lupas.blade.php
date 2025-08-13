@extends('layouts.auth')

@section('content')
    @if (Auth::check())
        <script>
            window.location.href = '<?= url('home') ?>'; //using a named route
        </script>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card-body">
                    <div class="card card-profile">
                        <div class="card-header" style="background-image: url({{ asset('auth/img/background.png') }}">
                            <div class="profile-picture">
                                <div class="avatar avatar-xl">
                                    <img src="{{ asset('auth/img/face-id.png') }}" alt="..."
                                        class="avatar-img rounded-pentagon">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name">Lupa Password ?</div>
                                <div class="desc">Masukan data untuk melakukan reset</div>
                                <div class="view-profile text-left">
                                    <form method="POST" action="{{ route('kirim-data') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="email">{{ __('Email') }}</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="no_telp">{{ __('Nomor Telepon') }}</label>
                                                <input id="no_telp" type="text"
                                                    class="form-control @error('no_telp') is-invalid @enderror"
                                                    name="no_telp" required >
                                                @error('no_telp')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-warning btn-block">
                                                    {{ __('Kirim') }}
                                                </button>
                                                <a href="/" class="btn btn-link btn-block">Kembali ke Halaman Login</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
