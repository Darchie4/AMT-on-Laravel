@extends('layouts.admin')

@section('head')
    @include('partials._tinymceSetup')
@endsection

@section('admin_content')
    @include('partials._systemFeedback')

    <div class="container">
        <!--All users button + back-->
        <div class="d-grid d-md-flex gap-2"><br>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="{{route('admin.instructors.index')}}">{{__('customLabels.instructor_all_instructors')}}</a>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="javascript:history.back()">{{__('customLabels.back')}}</a>
        </div>

        <div class="row justify-content-md-center">
            <!--General user info-->
            <div class="card">
                <div class="card-header">
                    {{__('customLabels.instructor_instructor')}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.instructors.update', ['id'=>$instructor->id])}}"
                          enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <p class="card-text">
                        <div class="row my-3">
                            <div class="col-6">
                                <label for="name"
                                       class="form-label">{{ __('customLabels.instructor_edit_short_description') }}</label>
                                <input class="form-control @error('short_description') is-invalid @enderror" type="text" name="short_description"
                                       value="{{old('short_description', $instructor->short_description ?? '')}}"
                                       autocomplete="short_description" required>
                                @error('short_description')
                                <span class="invalid-feedback">
                                        {{__('instructor.small_description_required')}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label
                                    for="profile_img_path">{{__('customlabels.instructor_edit_profile_img')}}</label>
                                <br>
                                @if(isset($instructor) && $instructor->profile_img_path)
                                    <img
                                        src="{{ old('profile_img_path') ? asset(old('profile_img_path')) : asset($instructor->profile_img_path) }}"
                                        alt="{{__('customLabels.instructor_profile_img')}}" style="max-width: 200px;"><br>
                                @endif
                                <input class="form-control" id="profile_img_path" name="profile_img_path"
                                       type="file"
                                       accept="image/png, image/jpeg"><br>
                            </div>
                        </div>
                        <div>
                            <label for="long_description"
                                   class="form-label">{{ __('customLabels.instructor_edit_long_description') }}</label>
                            <textarea required class="form-control @error('long_description') is-invalid @enderror" name="long_description" id="tinymce" rows="4" required
                                      autocomplete="long_description">@if(old('long_description', isset($instructor) ? $instructor->long_description : null))
                                    {{ old('long_description', $instructor->long_description) }}
                                @endif</textarea>
                            <br>
                            @error('long_description')
                            <span class="invalid-feedback" role="alert">
                                        {{__('instructor.long_description_required')}}
                                    </span>
                            @enderror

                        </div>
                        @php
                            $user = $instructor->user
                        @endphp
                        @include('partials._userInfoInput')
                        <button type="submit"
                                class="btn btn-success mb-2 mt-2 px-3">{{__('customLabels.edit')}}</button>
                    </form>
                </div>
            </div>
            <hr>
            <!--Role management-->
            <div class="card">
                <div class="card-header">
                    {{__('customLabels.roles')}}
                </div>
                <div class="card-body">
                    <!--See roles-->
                    <p>Current roles for user:</p>
                    <ul>
                        @if($instructor->user->roles)
                            @foreach($instructor->user->roles as $user_role)
                                <form method="POST"
                                      action="{{route('admin.users.roles.remove', [$instructor->user->id,$user_role->id])}}"
                                      onsubmit="return confirm('{{__('customLabels.confirm')}}')">
                                    @csrf
                                    @method('DELETE')
                                    <li>
                                        <button type="submit" class="btn btn-link">{{$user_role->name}}</button>
                                    </li>
                                </form>
                            @endforeach
                        @endif

                    </ul>
                    <!--Assign roles-->
                    <form method="POST" action="{{route('admin.users.roles.assign',$instructor->user->id)}}">
                        @csrf
                        <label for="role">{{__('customLabels.role_name')}}</label>
                        <select type="text" name="role" autocomplete="role-name">
                            @foreach($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                        <button type="submit"
                                class="btn btn-success mb-2 mt-2 px-3">{{__('customLabels.assign')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
