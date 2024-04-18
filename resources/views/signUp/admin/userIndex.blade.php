@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    @include('partials._systemFeedback')

    <div class="container">
        <div>
            <h1 class="text-center text-primary">{{__('registration.admin_userIndex_tittle_welcome', ['fname' => $user->name, 'lname' => $user->lname])}}</h1>

            <p class="my-5">
                @if(empty(__('registration.admin_userIndex_pageDescriptionHTML')) ||__('registration.admin_userIndex_pageDescriptionHTML') == 'registration.admin_userIndex_pageDescriptionHTML')
                    {{ __('registration.admin_userIndex_pageDescription', ['fname' => $user->name, 'lname' => $user->lname]) }}
                @else
                    {!! __('registration.admin_userIndex_pageDescriptionHTML', ['fname' => $user->name, 'lname' => $user->lname]) !!}
                @endif
            </p>
        </div>

        <h2 class="text-center text-primary">{{__('registration.admin_userIndex_tittle_currentRegistrations')}}</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>{{__('registration.admin_userIndex_lessonName')}}</th>
                <th>{{__('registration.admin_userIndex_fromDate')}}</th>
                <th>{{__('registration.admin_userIndex_price')}}</th>
                <th>{{__('registration.admin_userIndex_functions')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($registrations->where('is_active', true)->all() as $registration)
                @php($lesson = $registration->lesson()->first())
                <tr>
                    <td><a href="{{route('lesson.show', ['id'=> $lesson->id])}}">{{$lesson->name}}</a></td>
                    <td>{{$registration->activation_date}}</td>
                    <td>{{$lesson->price}}</td>
                    <td>
                        <form method="POST"
                              action="{{route('admin.registrations.end', [$registration->id])}}"
                              onsubmit="return confirm('{{__('registration.admin_userIndex_functions_confirm_cancelRegistration', ['fname' => $user->name, 'lname' => $user->lname, 'lessonName' => $lesson->name])}}')">
                            @csrf
                            @method('POST')
                            <button type="submit"
                                    class="btn btn-danger">{{__('registration.admin_userIndex_functions_cancelRegistration')}}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>


        @php($inactiveRegistrations = $registrations->where('is_active', false)->all())
        @if(count($inactiveRegistrations) != 0)
            <h2 class="text-center text-primary mt-5">{{__('registration.admin_userIndex_tittle_pastRegistrations')}}</h2>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>{{__('registration.admin_userIndex_lessonName')}}</th>
                    <th>{{__('registration.admin_userIndex_fromDate')}}</th>
                    <th>{{__('registration.admin_userIndex_toDate')}}</th>
                    <th>{{__('registration.admin_userIndex_price')}}</th>
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
                    </tr>
                @endforeach

                </tbody>

            </table>
        @endif
    </div>

@endsection
