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
                        <div class="row row-cols-2">
                            <div class="col-md-6">
                                <h5 class="card-title">{{ $instructor->user->name, $instructor->user->lname}}</h5>
                                <p class="card-text">{{__('customLabels.email')}}: {{ $instructor->user->email }}</p>
                                <p class="card-text">{{__('customLabels.phone')}}: {{ $instructor->user->phone }}</p>
                                <p class="card-text">{{__('customLabels.birthday')}}
                                    : {{ $instructor->user->birthday }}</p>
                                <p class="card-text">{{__('customLabels.gender')}}: {{ $instructor->user->gender }}</p>
                                <p class="card-text">
                                    {{__('customLabels.roles')}}:
                                    @foreach($instructor->user->roles as $user_role)
                                        {{($user_role->name).(!$loop->last ? ', ' : '')}}
                                    @endforeach
                                </p>
                                <p class="card-text">{{__('customLabels.user_joined')}}:
                                    {{ $instructor->user->created_at->translatedFormat('j. F Y') }}</p>
                                <p>
                                    <a role="button" class="btn btn-primary"
                                       href="{{route('admin.instructors.edit', $instructor->id)}}">{{__('customLabels.edit')}}</a>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <div class="row row-cols-auto">
                                    <div>
                                        @if(isset($instructor) && $instructor->profile_img_path)
                                            <img
                                                src="{{ old('profile_img_path') ? asset(old('profile_img_path')) : asset($instructor->profile_img_path) }}"
                                                alt="{{__('customLabels.instructor_profile_img')}}" style="max-width: 100px;"
                                                class="img-thumbnail card-img justify-content-md-center"><br>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="card-text">{!!$instructor->long_description!!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
