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
                                <div class="name">Login</div>
                                <div class="desc">Masukan data dengan benar</div>
                                <div class="view-profile text-left">
                                    <form method="POST" action="{{ route('login') }}">
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
                                                <label for="password">{{ __('Password') }}</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 text-left">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" onchange="check()"
                                                            id="lihat">
                                                        <span class="form-check-sign" for="lihat">
                                                            {{ __('Lihat Password') }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-warning btn-block">
                                                    {{ __('Login') }}
                                                </button>
                                                <a href="{{ route('lupa-password') }}" class="btn btn-link btn-block">Lupa Password</a>
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
