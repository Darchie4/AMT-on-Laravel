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
            <div class="card">
                <div class="card-header">
                    {{__('customLabels.instructor_instructor')}}
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate method="POST"
                          action="{{route('admin.instructors.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <p class="card-text">
                        <div class="row my-3">
                            <!--Choose user-->
                            <div class="col-6">
                                <label for="user">{{__('customLabels.instructor_choose_user')}}</label>
                                <select class="form-select @error('user_id') is-invalid @enderror" type="text"
                                        name="user_id" required>
                                    @foreach($users as $user)
                                        @unless($user->instructor)
                                            <option value="{{$user->id}}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{$user->email}}</option>
                                        @endunless
                                    @endforeach
                                </select>
                            </div>
                            <!--Profile Image-->
                            <div class="col-6">
                                <label
                                    for="profile_img_path">{{__('customlabels.instructor_edit_profile_img')}}</label>
                                <br>
                                <input class="form-control" id="profile_img_path" name="profile_img_path"
                                       type="file"
                                       accept="image/png, image/jpeg"><br>
                            </div>
                            <!--Short description-->
                            <div class="mt-2">
                                <label for="short_description"
                                       class="form-label">{{ __('customLabels.instructor_edit_short_description') }}</label>
                                <input class="form-control @error('short_description') is-invalid @enderror" type="text"
                                       name="short_description"
                                       value="{{old('short_description')}}" required>
                                @error('short_description')
                                <span class="invalid-feedback">
                                        {{__('instructor.small_description_required')}}
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div>
                            <label for="tinymce"
                                   class="form-label">{{ __('customLabels.instructor_edit_long_description') }}</label>
                            <textarea class="form-control @error('long_description') is-invalid @enderror" name="long_description" id="tinymce" rows="4" required
                                      >
                            </textarea>
                            <br>
                            @error('long_description')
                            <span class="invalid-feedback">
                                        {{__('instructor.long_description_required')}}
                                    </span>
                            @enderror

                        </div>
                        </p>
                        {{--@include('partials._userInfoInput')--}}
                        <button type="submit"
                                class="btn btn-success mb-2 mt-2 px-3">{{__('customLabels.create')}}</button>
                    </form>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
