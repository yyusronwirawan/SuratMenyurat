@extends('auth.auth')
@section('title', 'Send Password Reset Link')
@section('content')
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner" style="max-width: 550px">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center mb-1">
                        <a href="#" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('img/logo/Logo-FMIPA-UI.png') }}" style="width: 150px;height: auto;">
                            </span>
                        </a>
                    </div>
                    <div class="app-brand justify-content-center mb-4">
                        <a href="#" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('/img/logo/logo-app.png') }}" style="width: 250px;height: auto;">
                            </span>
                        </a>
                    </div>
                    <p class="text-center mb-4" style="font-weight: bolder; font-size: 16px;">
                        RESET PASSWORD</p>
                    <hr style="margin-top: -15px;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
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


                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Send Password Reset Link</button>
                        </div>
                    </form>
                    <div class="form-social"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
