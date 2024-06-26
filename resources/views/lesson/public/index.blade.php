@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    @include('partials._systemFeedback')
    <div class="container">
        <div class="my-5 text-center">
            <h1>{{__('lesson.public_index_welcomeTittle')}}</h1>
            <p>{!! __('lesson.public_index_welcomeDescription') !!}</p>
        </div>
        <div class="my-5 row g2">
            <div class="col">
            </div>
            <div class="col">
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($lessons as $lesson)
                @if($lesson->visible)
                    <div class="col">
                        <div class="card w-100">
                            <div class="card-header">
                                @can(['lessons_crud','lessons_own'])
                                <div class="row row-cols-3 justify-content-md-between">
                                    <div class="d-grid col-md-3 d-grid justify-content-md-start">
                                        <a class="btn my-auto text-dark btn-outline-danger" role="button"
                                           href="{{route('admin.lesson.remove', ['id' => $lesson->id])}}">{{__('lesson.admin_index_button_delete')}}</a>
                                    </div>
                                    <div class="d-grid col-md-3 justify-content-md-center text-center">
                                        <h4 class="card-title text-primary mx-auto">{{$lesson->name}}</h4>
                                    </div>
                                    <div class="d-grid col-md-3 d-grid justify-content-md-end">
                                        <a class="btn my-auto text-dark btn-outline-warning" role="button"
                                           href="{{route('admin.lesson.edit', ['id' => $lesson->id])}}">{{__('lesson.admin_index_button_edit')}}</a>
                                    </div>
                                </div>
                                @else
                                    <div class="text-center">
                                        <h4 class="card-title text-primary mx-auto">{{$lesson->name}}</h4>
                                    </div>
                                @endcan
                            </div>
                            <img src="{{asset($lesson->cover_img_path)}}" class="card-img"
                                 alt="{{__('lesson.public_index_imgAltText')}} {{$lesson->name}}">
                            <div class="card-body">
                                <div class="row p-0">
                                    <div class="col">
                                        <h5 class="text-secondary">{{__('lesson.public_index_tittleGeneralInformation')}}</h5>
                                        <b>{{__('lesson.public_index_ageSpan')}}</b> {{$lesson->age_min}}
                                        - {{$lesson->age_max}}<br>
                                        <b>{{__('lesson.public_index_danceStyle')}}</b> {{$lesson->danceStyle->name}}
                                        <br>
                                        <b>{{__('lesson.public_index_difficulty')}}</b> {{$lesson->difficulty->name}}
                                        <br>
                                    </div>
                                    <div class="col">
                                        <h5 class="text-secondary">{{$lesson->instructors->count() >1 ? __('lesson.public_index_teacherPlural') : __('lesson.public_index_teacherSingle')}}</h5>
                                        @foreach($lesson->instructors as $instructor)
                                            <a href="{{route('instructors.public.show', ['id' => $instructor->id])}}">{{$instructor->user->name}}</a><br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card-body py-0">
                                <h5 class="text-secondary"> {{__('lesson.public_index_trainingTimes')}}</h5>
                                <div>


                                    @foreach($lesson->lessonTimeLocations as $lessonTimeLocation)
                                        @if($loop -> first || $loop->index % 3 == 0)
                                            <div class="row">
                                        @endif
                                        <div class="col">
                                            <b>{{__('lesson.public_index_location')}}</b> {{$lessonTimeLocation ->location->name}}
                                            <br>
                                            <b>{{__('lesson.public_index_weekDay')}}</b> {{trans(Carbon::getDays()[$lessonTimeLocation->week_day])}}
                                            <br>
                                            <b>{{__('lesson.public_index_timeStart')}}</b> {{$lessonTimeLocation -> start_time}}
                                            <br>
                                            <b>{{__('lesson.public_index_timeEnd')}}</b> {{$lessonTimeLocation ->end_time}}
                                            <br>
                                        </div>
                                        @if(!$loop -> last && ($loop->index+1) % 3 != 0)
                                            <hr class="vr p-0">
                                        @elseif(!$loop -> last && ($loop->index+1) % 3 == 0)
                                            </div>
                                            <hr class="p-0">
                                        @elseif($loop -> last || ($loop->index+1) % 3 == 0)
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                        <div class="card-body my-0">
                            <h5 class="text-secondary">{{__('lesson.public_index_shortDescription')}}</h5>
                            {{$lesson->short_description}}
                        </div>
                        <div class="card-body my-0">
                            <div class="row">
                                <div class="col text-center">
                                    <a class="m-auto btn btn-primary px-5"
                                       href="{{route('lesson.show', ['id' => $lesson->id])}}">{{__('lesson.public_index_showInformation')}}</a>
                                </div>
                                <div class="col text-center">
                                    @if($lesson->canSignup())
                                        <a class="m-auto btn btn-success px-5"
                                           href="{{route('signups.public.signup', ['id' => $lesson->id])}}">{{__('lesson.public_index_signup')}}</a>
                                    @else
                                        <a class="m-auto btn btn-danger px-5">{{__('lesson.public_index_signup')}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
