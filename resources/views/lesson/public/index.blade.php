@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
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
                <div class="col">
                    <div class="card w-100">
                        <div class="card-header text-center">
                            <h4 class="card-title text-primary mx-auto">{{$lesson->name}}</h4>
                        </div>
                        <img src="{{asset($lesson->cover_img_path)}}" class="card-img"
                             alt="{{__('lesson.public_index_imgAltText')}} {{$lesson->name}}">
                        <div class="card-body">
                            <div class="row p-0">
                                <div class="col">
                                    <h5 class="text-secondary">{{__('lesson.public_index_tittleGeneralInformation')}}</h5>
                                    <b>{{__('lesson.public_index_ageSpan')}}</b> {{$lesson->age_min}}
                                    - {{$lesson->age_max}}<br>
                                    <b>{{__('lesson.public_index_danceStyle')}}</b> {{$lesson->danceStyle->name}}<br>
                                    <b>{{__('lesson.public_index_difficulty')}}</b> {{$lesson->difficulty->name}}<br>
                                </div>
                                <div class="col">
                                    <h5 class="text-secondary">{{$lesson->instructors->count() >1 ? __('lesson.public_index_teacherPlural') : __('lesson.public_index_teacherSingle')}}</h5>
                                    @foreach($lesson->instructors as $instructor)
                                        {{$instructor->user->name}} <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card-body py-0">
                            <h5 class="text-secondary"> {{__('lesson.public_index_trainingTimes')}}</h5>
                            <div>

                                @foreach($lesson->lessonTimeLocations as $lessonTimeLocation)
                                    @if($loop -> first || $loop->index % 3 == 0)
                                        <div class="row row-cols-auto">
                                            @endif
                                            <div class="col row-cols-auto">
                                                <b>{{__('lesson.public_index_location')}}</b> {{$lessonTimeLocation ->location->name}} <br>
                                                <b>{{__('lesson.public_index_weekDay')}}</b> {{trans(Carbon::getDays()[$lessonTimeLocation->week_day-1])}}
                                                <br>
                                                <b>{{__('lesson.public_index_timeStart')}}</b> {{$lessonTimeLocation -> start_time}} <br>
                                                <b>{{__('lesson.public_index_timeEnd')}}</b> {{$lessonTimeLocation ->end_time}} <br>
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
                                <a class="m-auto btn btn-primary px-5" href="{{route('lesson.show', ['id' => $lesson->id])}}">{{__('lesson.public_index_showInformation')}}</a>
                            </div>
                            <div class="col text-center">
                                <a class="m-auto btn btn-success px-5" href="{{route('lesson.signup', ['id' => $lesson->id])}}">{{__('lesson.public_index_signup')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        @endforeach
    </div>
    </div>

@endsection
