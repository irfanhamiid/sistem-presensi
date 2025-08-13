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
                                <div class="name">{{ $data->nama }}</div>
                                <div class="desc">Apakah kamu yakin ingin reset password ?</div>
                                <div class="view-profile text-left">
                                    <form method="POST" action="{{ route('store-reset',$data->reset_token) }}">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="password">{{ __('Password Baru') }}</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                                    value="{{ old('password') }}" required autocomplete="password" autofocus>

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="password1">{{ __('Konfirmasi Password') }}</label>
                                                <input id="password1" type="password"
                                                    class="form-control @error('password1') is-invalid @enderror"
                                                    name="password1" required >
                                                @error('password1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-warning btn-block">
                                                    {{ __('Reset Password') }}
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
