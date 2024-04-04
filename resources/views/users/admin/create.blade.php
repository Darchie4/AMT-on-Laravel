@extends('layouts.admin')
@section('admin_content')
    <div class="container">
        <!--All users button-->
        <div class="d-grid d-md-flex gap-2"><br>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="{{route('admin.users.index')}}">{{__('customLabels.all_users')}}</a>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="javascript:history.back()">{{__('customLabels.back')}}</a>
        </div>

        <div class="row justify-content-md-center">
            <!--General user info-->
            <div class="card">
                <div class="card-header">
                    {{__('customLabels.users')}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.users.store')}}">
                        @csrf
                        <p class="card-text">

                            @include('partials._userInfoInput')
                            @include('partials._addressInput')
                            @include('partials._passwordInput')

                            <button type="submit"
                                    class="btn btn-success mb-2 mt-2 px-3">{{__('customLabels.create')}}</button>
                    </form>
                </div>
            </div>
@endsection
