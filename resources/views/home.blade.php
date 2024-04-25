@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">{{ __('home.profile_title') }}</div>

                <div class="card-body">
                    @can('admin_dashboard')
                        <a class="btn btn-primary" role="button" href="{{route('admin.index')}}">
                            {{__('home.go_to_admin')}}</a>
                        <hr>
                    @endcan
                        <form method="POST" action="{{route('admin.users.update',Auth::user()->id)}}">
                            @csrf
                            @method('PUT')
                                @include('partials._userInfoInput',['user' => Auth::user()])
                                @include('partials._addressInput',['addressOld' => Auth::user()->address])
                            <div class="d-flex justify-content-end">
                                <button type="submit"
                                        class="btn btn-primary mb-2 mt-2 px-3 btn-lg">{{__('home.edit_information')}}</button>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
