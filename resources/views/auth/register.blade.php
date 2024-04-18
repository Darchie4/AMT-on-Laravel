@extends('layouts.app')

@section('content')
    @include('partials._systemFeedback')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">{{ __('customLabels.Register') }}</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            @include('partials._userInfoInput')
                            @include('partials._addressInput')
                            @include('partials._passwordInput')

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
