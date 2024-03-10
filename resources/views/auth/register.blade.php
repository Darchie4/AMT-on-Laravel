@extends('layouts.app')

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">{{ __('customLabels.Register') }}</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            @include('partials._userInfoInput')
                            <!--Passwords-->
                            <div class="row my-3">
                                <div class="col-6">
                                    <label for="password" class="form-label">{{ __('customLabels.password') }}</label>
                                    <input class="form-control" type="password" name="password"
                                           value="{{old('password')}}"
                                           required autocomplete="new-password" @error('password') is-invalid @enderror>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="password_confirmation"
                                           class="form-label">{{ __('customLabels.password-confirm') }}</label>
                                    <input class="form-control" type="password" name="password_confirmation"
                                           id="password_confirmation"
                                           required autocomplete="new-password">
                                </div>
                            </div>

                            <!--Submit-->
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">
                                        {{ __('customLabels.Register') }}
                                    </button>
                                </div>
                            </div>

                            <!--Log ind link-->
                            <div class="row my-2">
                                <div class="col-md-6 offset-md-3 text-center">
                                    <p>{{__('customLabels.existing-user')}}
                                        <a href="{{route('login')}}">{{__('customLabels.login-here')}}</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
