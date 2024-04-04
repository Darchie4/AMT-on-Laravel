@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')

    <div class="container">
        <div>
            <h1 class="text-center text-primary">{{__('registration.public_index_tittle_welcome')}}</h1>

            <p class="my-5">
                @if(empty(__('registration.public_index_pageDescriptionHTML')) ||__('registration.public_index_pageDescriptionHTML') == 'registration.public_index_pageDescriptionHTML')
                    {{ __('registration.public_index_pageDescription') }}
                @else
                    {!! __('registration.public_index_pageDescriptionHTML') !!}
                @endif
            </p>
        </div>

        <h2 class="text-center text-primary">{{__('registration.public_index_tittle_currentRegistrations')}}</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>{{__('registration.public_index_lessonName')}}</th>
                <th>{{__('registration.public_index_fromDate')}}</th>
                <th>{{__('registration.public_index_time')}}</th>
                <th>{{__('registration.public_index_price')}}</th>
                <th>{{__('registration.public_index_functions')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($registrations->where('is_active', true)->all() as $registration)
                @php($lesson = $registration->lesson()->first())
                <tr>
                    <td><a href="{{route('lesson.show', ['id'=> $lesson->id])}}">{{$lesson->name}}</a></td>
                    <td>{{$registration->activation_date}}</td>
                    <td>
                        @foreach($lesson->lessonTimeLocations()->get() as $lessonTimeLocation)
                            {{trans(Carbon::getDays()[$lessonTimeLocation->week_day])}} {{$lessonTimeLocation->start_time}}
                            - {{$lessonTimeLocation->end_time}} <br>
                        @endforeach
                    </td>
                    <td>{{$lesson->price}}</td>
                    <td><a href="{{route('lesson.show', ['id'=> $lesson->id])}}">{{$lesson->name}}</a></td>
                </tr>
            @endforeach

            </tbody>

        </table>


        @php($inactiveRegistrations = $registrations->where('is_active', false)->all())
        @if(count($inactiveRegistrations) != 0)
            <h2 class="text-center text-primary mt-5">{{__('registration.public_index_tittle_pastRegistrations')}}</h2>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>{{__('registration.public_index_lessonName')}}</th>
                    <th>{{__('registration.public_index_fromDate')}}</th>
                    <th>{{__('registration.public_index_toDate')}}</th>
                    <th>{{__('registration.public_index_price')}}</th>
                    <th>{{__('registration.public_index_functions')}}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($inactiveRegistrations as $registration)
                    @php($lesson = $registration->lesson()->first())
                    <tr>
                        <td><a href="{{route('lesson.show', ['id'=> $lesson->id])}}">{{$lesson->name}}</a></td>
                        <td>{{$registration->activation_date}}</td>
                        <td>{{$registration->deactivation_date}}</td>
                        <td>{{$lesson->price}}</td>
                        <td><a href="{{route('lesson.show', ['id'=> $lesson->id])}}">{{$lesson->name}}</a></td>
                    </tr>
                @endforeach

                </tbody>

            </table>
        @endif
    </div>

@endsection
