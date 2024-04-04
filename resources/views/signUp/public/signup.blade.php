@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{__('lesson.public_signup_public_signup_welcome')}}</h1>


        {{__('lesson.public_signup_public_signup_nameOfLesson')}} {{$lesson->name}}
        {{__('lesson.')}}
        {{__('lesson.')}}
        <form class="row g-3"
              action="{{route("signups.public.doSignup", ['lesson_id' => $lesson->id, 'user_id' => Auth::user()->id])}}"
              method="post">
            @csrf
            @method('post')

            <button type="submit">{{__('lesson.public_signup_public_signup_confirm')}}</button>

        </form>

        <a href="{{ URL::previous() }}">{{__('lesson.public_signup_public_signup_goBack')}}</a>
    </div>

@endsection
