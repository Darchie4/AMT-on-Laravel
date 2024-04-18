@php use Carbon\Carbon; @endphp
@extends('layouts.admin')

@section('head')
    <script src="{{ asset('js/admin/registration/indexFormControl.js') }}"></script>

@endsection

@section('admin_content')
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

        <form action="{{route("admin.registrations.moveMultiple")}}" method="post"
              enctype="multipart/form-data">
            @csrf
            <input name="lessonId" value="{{$lesson->id}}" hidden>
            <div class="my-5 row g2">
                <div class="col">
                    <h2>{{__('registration.admin_index_statistics_tittle')}}</h2>
                    <b>{{__('registration.admin_index_statistics_signupActiveCount')}}
                        : </b> {{$registrations->where('is_active', true)->count()}} <br>
                    <b>{{__('registration.admin_index_statistics_signupDeActiveCount')}}
                        : </b> {{$registrations->where('is_active', false)->count()}} <br>
                </div>
                @can('registration_admin')
                    <div class="col">
                        <h2>{{__('registration.admin_index_links')}}</h2>
                        <div class="my-2 row">
                            <a class="btn btn-sm btn-danger" id="deleteAllButton"
                               href="{{route('admin.registrations.endAll', ['lesson' => $lesson->id])}}">{{__('registration.admin_index_inactivateAll')}}</a>
                            <button type="submit" class="form-control btn btn-danger" id="deleteSelectedButton"
                                    formaction="{{route("admin.registrations.endMultiple")}}">{{__('registration.admin_index_deleteSelected')}}</button>
                        </div>
                        <div class="my-2 row">
                            <a class="btn btn-sm btn-primary" id="moveAllButton"
                               href="{{route('admin.registrations.moveAll', ['lesson' => $lesson->id])}}">{{__('registration.admin_index_moveAll')}}</a>
                            <button type="submit" class="form-control btn btn-primary" id="moveSelectedButton"
                                    formaction="{{route("admin.registrations.moveMultiple")}}">{{__('registration.admin_index_moveSelected')}}</button>
                        </div>
                    </div>
                @endcan
            </div>
            <h2 class="text-center text-primary">{{__('registration.admin_lessonIndex_tittle_currentRegistrations')}}</h2>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#
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
                        <td><input class="form-check-input" type="checkbox" id="selected_{{$user->id}}"
                                   name="selected_{{$user->id}}"></td>

                        <td>{{$user->name}}</td>

                        <td>{{ Carbon::parse($user->birthday)->age }}</td>
                        <td>{{$user->address()->first()->fullAddress()}}</td>
                        <td>{{$registration->activation_date}}</td>
                        <td class="row row-cols">
                            <div class="col">
                                <form method="POST" action="{{route('admin.registrations.end', [$registration->id])}}"
                                      onsubmit="return confirm('{{__('registration.admin_lessonIndex_functions_confirm_cancelRegistration', ['userName' => $user->name])}}')">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-danger">{{__('registration.admin_lessonIndex_functions_cancelRegistration')}}</button>
                                </form>
                            </div>
                            <div class="col">
                                <a href="{{route('admin.registrations.moveSingle', ['lesson' => $lesson->id, 'user'=>$user->id])}}"
                                   class="btn btn-warning">{{__('registration.admin_lessonIndex_functions_moveUser')}}</a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <table class="table table-striped table-hover">
                @if($registrations->where('is_active', true)->count() == 0)
                    <h2 class="text-warning text-center">{{__('registration.registration_index_noRegistrations')}}</h2>
            @endif
        </form>

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
