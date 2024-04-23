@php use Carbon\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <div class="container">
        <!--All users button + back-->
        <div class="d-grid d-md-flex gap-2"><br>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="{{route('instructors.public.index')}}">{{__('customLabels.instructor_all_instructors')}}</a>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="javascript:history.back()">{{__('customLabels.back')}}</a>
        </div>
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mx-auto">{{$instructor->user->name}} {{$instructor->user->lname}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-2">
                            <div class="col-md-6">
                                <h5 class="card-title"></h5>
                                <p class="card-text">{{__('customLabels.email')}}: <a href="mailto:{{ $instructor->user->email }}">{{ $instructor->user->email }}</a></p>
                                <p class="card-text">{{__('customLabels.phone')}}: <a href="tel:{{ $instructor->user->phone }}"> {{ $instructor->user->phone }}</a></p>
                                <p class="card-text">{{__('instructor.public_show_age')}}: {{Carbon::parse($instructor->user->birthday)->diff(Carbon::now())->y}} {{__('instructor.public_show_age_time')}} ({{Carbon::parse($instructor->user->birthday)->translatedFormat('j. F Y')}})</p>
                                <p class="card-text">{{__('customLabels.gender')}}: {{__('user.'.$instructor->user->gender) }}</p>
                                <p class="card-text">
                                    {{__('instructor.public_show_lessons')}}:
                                    @foreach($instructor->lessons as $lesson)
                                        <a href="{{route('lesson.show', ['id'=> $lesson->id])}}">{{($lesson->name)}}</a>{!!($loop->index%5 && $loop->index != 0 && !$loop->last || $loop->first) ? ', ' : '<br>'!!}
                                    @endforeach
                                </p>
                                <p class="card-text">{{__('customLabels.user_joined')}}:
                                    {{ $instructor->user->created_at->translatedFormat('j. F Y') }}</p>
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
