@extends('layouts.admin')

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
                    <form method="POST" action="{{route('admin.instructors.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <p class="card-text">
                        <div class="row my-3">
                            <!--Choose user-->
                            <div class="col-6">
                                <label for="user">{{__('customLabels.instructor_choose_user')}}</label>
                                <select class="form-select" type="text" name="user_id">
                                    @foreach($users as $user)
                                        @unless($user->instructor)
                                        <option value="{{$user->id}}">{{$user->email}}</option>
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
                                <input class="form-control" type="text" name="short_description"
                                       autocomplete="short_description" autofocus
                                       @error('short_description') is-invalid @enderror>
                                @error('short_description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div>
                            <label for="long_description"
                                   class="form-label">{{ __('customLabels.instructor_edit_long_description') }}</label>
                            <textarea class="form-control" name="long_description" rows="4" required
                                      autocomplete="long_description">
                            </textarea>
                            <br>
                            @error('long_description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
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
