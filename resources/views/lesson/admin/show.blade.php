@php use Carbon\Carbon; @endphp
@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <h1 class="text-center">{{$lesson -> name}}</h1>

            <div class="col col-lg-7 vh-50">

                <div>
                    <h2>{{__('admin_show_title_practicalInformation')}}</h2>
                    <b>{{__('admin_show_danseStyle')}}</b> {{$lesson->danceStyle->name}}<br>
                    <b>{{__('admin_show_difficulty')}}</b> {{$lesson->difficulty->name}}<br>
                    <b>{{__('admin_show_ageGroup')}}</b> {{$lesson->age_min}} - {{$lesson->age_max}} år<br>
                    <b>{{__('admin_show_price')}}</b> {{$lesson->price}} DKK.<br>
                    <b>{{__('admin_show_seasonStart')}}</b> {{Carbon::parse($lesson->season_start)->format("d-m-Y")}}<br>
                    <b>{{__('admin_show_seasonEnd')}}</b> {{Carbon::parse($lesson->season_end)->format("d-m-Y")}}<br>
                </div>

                <div>
                    <h2 class="pt-3">{{__('admin_show_trainingTimes')}}</h2>
                    @foreach($lesson->lessonTimeLocations as $lessonTimeLocation)
                        @if($loop -> first || $loop->index % 3 == 0)
                            <div class="row row-cols-auto">
                        @endif
                                <div class="col row-cols-auto">
                                    <b>{{__('lesson.public_index_location')}}</b> {{$lessonTimeLocation ->location->name}}
                                    <br>
                                    <b>{{__('lesson.public_index_weekDay')}}</b> {{trans(Carbon::getDays()[$lessonTimeLocation->week_day])}}
                                    <br>
                                    <b>{{__('lesson.public_index_timeStart')}}</b> {{$lessonTimeLocation -> start_time}}
                                    <br>
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

        <div class="col col-lg-5 vh-50">
            <div class="p-2">
                <img src="{{asset($lesson->cover_img_path)}}"
                     class="w-50 img-fluid mx-auto "
                     alt="Billede af: {{$lesson->name}}">
            </div>

            <div class="shadow-lg p-3 mb-5 bg-body rounded container">
                <h2 class="text-center">{{__('admin_show_teachers')}}</h2>
                @foreach($lesson->instructors as $instructor)
                    @if($loop->index % 2 == 0)
                        <div class="row">
                    @endif
                            <div class="col text-center p-0 mx-0">
                                <img src="{{asset($instructor->profile_img_path)}}"
                                     class="w-50 img-fluid mx-auto d-block img-thumbnail rounded-circle"
                                     alt="Billede af: {{$instructor->user->name}}">
                                {{$instructor->user->name}}
                            </div>
                    @if($loop->index % 2 != 0 && !$loop->last)
                        </div>
                        <hr class="p-0">
                    @elseif($loop->index % 2 != 0 || $loop->last)
                        </div>
                    @else
                        <hr class="vr p-0">
                    @endif
            @endforeach
        </div>
    </div>
    <h2 class="pt-3">{{__('admin_show_description')}}</h2>
    {!! $lesson->logn_description !!}
    </div>

@endsection
