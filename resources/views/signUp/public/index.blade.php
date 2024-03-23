@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')

    <div class="container">
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
                        <td>{{$lesson->name}}</td>
                        <td>{{$registration->activation_date}}</td>
                        <td>
                            @foreach($lesson->lessonTimeLocations()->get() as $lessonTimeLocation)
                                {{trans(Carbon::getDays()[$lessonTimeLocation->week_day])}} {{$lessonTimeLocation->start_time}} - {{$lessonTimeLocation->end_time}} <br>
                            @endforeach
                        </td>
                        <td>{{$lesson->price}}</td>
                        <td>{{$lesson->name}}</td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>

@endsection
