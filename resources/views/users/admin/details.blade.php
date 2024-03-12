@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header">
                        {{__('customLabels.user_details')}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h5 class="card-title">{{ $user->name, $user->lname}}</h5>
                            <p class="card-text">{{__('customLabels.email')}}: {{ $user->email }}</p>
                            <p class="card-text">{{__('customLabels.phone')}}: {{ $user->phone }}</p>
                            <p class="card-text">{{__('customLabels.birthday')}}: {{ $user->birthday }}</p>
                            <p class="card-text">{{__('customLabels.gender')}}: {{ $user->gender }}</p>
                            <p class="card-text">
                                {{__('customLabels.roles')}}:
                                @foreach($user->roles as $user_role)
                                    {{$user_role->name}}@if(!$loop->last), @endif
                                @endforeach
                            </p>
                            <p class="card-text">{{__('customLabels.user_joined')}}:
                                {{ $user->created_at->translatedFormat('j. F Y') }}</p>
                            <p>
                            <a role="button" class="btn btn-primary" href="{{route('admin.users.edit', $user->id)}}">{{__('customLabels.edit')}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
