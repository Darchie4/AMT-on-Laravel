@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-4">
                    <div class="card-body">
                        <h2 class="card-title">{{ __('customLabels.Register') }}</h2>
                        <div method="POST" action="{{ route('register') }}">
                            @csrf

                            <!--Firstname + lastname-->
                            <div class="row my-3">
                                <div class="col-6">
                                    <label for="name" class="form-label">{{ __('customLabels.firstname') }}</label>
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}"
                                           required autocomplete="name" autofocus @error('name') is-invalid @enderror>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="lname" class="form-label">{{ __('customLabels.lastname') }}</label>
                                    <input class="form-control" type="text" name="lname" value="{{old('lname')}}"
                                           required autocomplete="lname" @error('lname') is-invalid @enderror>
                                    @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!--email + phone-->
                            <div class="row my-3">
                                <div class="col-6">
                                    <label for="email" class="form-label">{{ __('customLabels.email') }}</label>
                                    <input class="form-control" type="email" name="email" value="{{old('email')}}"
                                           required autocomplete="email" @error('email') is-invalid @enderror>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="phone" class="form-label">{{ __('customLabels.phone') }}</label>
                                    <input class="form-control" type="phone" name="phone" value="{{old('phone')}}"
                                           required autocomplete="phone" @error('phone') is-invalid @enderror>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!--Birthday + gender-->
                            <div class="row my-3">
                                <div class="col-6">
                                    <label for="birthday" class="form-label">{{ __('customLabels.birthday') }}</label>
                                    <input class="form-control" type="date" name="birthday" value="{{old('birthday')}}"
                                           required autocomplete="birthday" @error('birthday') is-invalid @enderror>
                                    @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="gender" class="form-label">{{ __('customLabels.gender') }}</label>
                                    <select class="form-select" name="gender"
                                            required @error('gender') is-invalid @enderror>
                                        <option selected>{{ __('customLabels.choose')}}</option>
                                        <option value="1">{{__('customLabels.male')}}</option>
                                        <option value="2">{{__('customLabels.female')}}</option>
                                        <option value="3">{{__('customLabels.other')}}</option>

                                        {{-- Implement when gender table exists (remember controller)
                                        @foreach($genders as $id => $gender)
                                            <option value="{{$id}}" {{old('gender') == $id? 'selected' : ''}}>{{ trans('customLabels.' . $gender->name)}}</option>
                                        @endforeach --}}

                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </select>
                                </div>
                            </div>

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
                                    <label for="password-confirm"
                                           class="form-label">{{ __('customLabels.password-confirm') }}</label>
                                    <input class="form-control" type="password" name="password-confirm"
                                           id="password-confirm"
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
