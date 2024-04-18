@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    @include('partials._systemFeedback')

    <div class="container">
        <div>
            <h1 class="text-center text-primary">{{__('registration.admin_lessonIndex_tittle_welcome', ['lessonName' => $lesson->name])}}</h1>

            <p class="my-5">
                @if(empty(__('registration.admin_lessonIndex_pageDescriptionHTML')) ||__('registration.admin_lessonIndex_pageDescriptionHTML') == 'registration.admin_lessonIndex_pageDescriptionHTML')
                    {{ __('registration.admin_lessonIndex_pageDescription', ['lessonName' => $lesson->name]) }}
                @else
                    {!! __('registration.admin_lessonIndex_pageDescriptionHTML', ['lessonName' => $lesson->name]) !!}
                @endif
            </p>
        </div>

        <h2 class="text-center text-primary">{{__('registration.admin_lessonIndex_tittle_currentRegistrations')}}</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>{{__('registration.admin_lessonIndex_userName')}}</th>
                <th>{{__('registration.admin_lessonIndex_userAge')}}</th>
                <th>{{__('registration.admin_lessonIndex_userAddress')}}</th>
                <th>{{__('registration.admin_lessonIndex_fromDate')}}</th>
                <th>{{__('registration.admin_lessonIndex_functions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($registrations->where('is_active', true)->all() as $registration)
                @php($user = $registration->user()->first())
                <tr>
                    <td>{{$user->name}}</td>

                    <td>{{ Carbon::parse($user->birthday)->age }}</td>
                    <td>{{$user->address()->first()->fullAddress()}}</td>
                    <td>{{$registration->activation_date}}</td>
                    <td>
                        <form method="POST" action="{{route('admin.registrations.end', [$registration->id])}}"
                              onsubmit="return confirm('{{__('registration.admin_lessonIndex_functions_confirm_cancelRegistration', ['userName' => $user->name])}}')">
                            @csrf
                            <button type="submit"
                                    class="btn btn-danger">{{__('registration.admin_lessonIndex_functions_cancelRegistration')}}</button>
                        </form>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        @if($registrations->where('is_active', true)->count() == 0)
            <h2 class="text-warning text-center">{{__('registration.registration_index_noRegistrations')}}</h2>
        @endif


        @php($inactiveRegistrations = $registrations->where('is_active', false)->all())
        @if(count($inactiveRegistrations) != 0)
            <h2 class="text-center text-primary mt-5">{{__('registration.admin_lessonIndex_tittle_pastRegistrations')}}</h2>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>{{__('registration.admin_lessonIndex_userName')}}</th>
                    <th>{{__('registration.admin_lessonIndex_userAge')}}</th>
                    <th>{{__('registration.admin_lessonIndex_userAddress')}}</th>
                    <th>{{__('registration.admin_lessonIndex_fromDate')}}</th>
                    <th>{{__('registration.admin_lessonIndex_toDate')}}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($inactiveRegistrations as $registration)
                    @php($user = $registration->user()->first())
                    <tr>
                        <td>{{$user->name}}</td>

                        <td>{{ Carbon::parse($user->birthday)->age }}</td>
                        <td>{{$user->address()->first()->fullAddress()}}</td>
                        <td>{{$registration->activation_date}}</td>
                        <td>{{$registration->deactivation_date}}</td>
                    </tr>
                @endforeach

                </tbody>

            </table>
        @endif
    </div>

@endsection
