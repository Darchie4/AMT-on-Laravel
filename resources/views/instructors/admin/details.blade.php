@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header">
                        {{__('customLabels.instructor_details')}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h5 class="card-title">{{ $instructor->user->name, $instructor->user->lname}}</h5>
                            <p class="card-text">{{__('customLabels.email')}}: {{ $instructor->user->email }}</p>
                            <p class="card-text">{{__('customLabels.phone')}}: {{ $instructor->user->phone }}</p>
                            <p class="card-text">{{__('customLabels.birthday')}}: {{ $instructor->user->birthday }}</p>
                            <p class="card-text">{{__('customLabels.gender')}}: {{ $instructor->user->gender }}</p>
                            <p class="card-text">
                                {{__('customLabels.roles')}}:
                                @foreach($instructor->user->roles as $user_role)
                                    {{$user_role->name}}@if(!$loop->last), @endif
                                @endforeach
                            </p>
                            <p class="card-text">{{__('customLabels.user_joined')}}:
                                {{ $instructor->user->created_at->translatedFormat('j. F Y') }}</p>
                            <p>
                            <a role="button" class="btn btn-primary" href="{{route('admin.instructors.edit', $instructor->id)}}">{{__('customLabels.edit')}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
