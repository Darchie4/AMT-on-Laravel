@php use App\Models\Lesson;use App\Models\Registration; @endphp
@extends('layouts.admin')

@section('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/admin/lesson/clickableRowsInTable.js') }}"></script>
@endsection

@section('admin_content')
    @include('partials._systemFeedback')
    <div class="container">
        <div class="my-5 text-center">
            <h1>{{__('lesson.admin_index_welcome')}}</h1>
        </div>
        <div class="my-5 row g2">
            <div class="col">
                <h2>{{__('lesson.admin_index_statistics_tittle')}}</h2>
                <b>{{__('lesson.admin_index_statistics_lessonCount')}}: </b> {{$lessons->count()}} <br>
                @php($activeRegistrations = Registration::where('is_active', '=', true)->count())
                <b>{{__('lesson.admin_index_statistics_totalActiveRegistrations')}}: </b> {{$activeRegistrations}}<br>
                <b>{{__('lesson.admin_index_statistics_totalSpaces')}}: </b> {{$lessons->sum('total_signup_space')-$activeRegistrations}} <br>
                <b>{{__('lesson.admin_index_statistics_totalFilledLessons')}}: </b> {{
                    Lesson::whereHas('registrations', function ($query) {$query->where('is_active', true);})
                    ->withCount(['registrations' => function ($query) {$query->where('is_active', true);}])
                    ->get()
                    ->filter(function ($lesson) {return $lesson->registrations_count == $lesson->total_signup_space;})
                    ->count()
                }}
                <br>
                <b>{{__('lesson.admin_index_statistics_totalAlmostFilledLessons')}}: </b> {{
                    Lesson::whereHas('registrations', function ($query) {$query->where('is_active', true);})
                    ->withCount(['registrations' => function ($query) {$query->where('is_active', true);}])
                    ->get()
                    ->filter(function ($lesson) {return (($lesson->registrations_count+2) >= $lesson->total_signup_space) && !($lesson->registrations_count == $lesson->total_signup_space);})
                    ->count()
                }}
                <br>
            </div>
            @can('admin_panel')
                <div class="col">
                    <h2>{{__('lesson.admin_index_links')}}</h2>
                    <a class="btn btn-primary"
                       href="{{route('admin.lesson.create')}}">{{__('lesson.admin_index_create_new')}}</a>
                </div>
            @endcan
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
                <thead class="table-dark">
                <tr>
                    <th scope="col">{{__('lesson.admin_index_table_name')}}</th>
                    <th scope="col">{{__('lesson.admin_index_table_age_min')}}</th>
                    <th scope="col">{{__('lesson.admin_index_table_age_max')}}</th>
                    <th scope="col">{{__('lesson.admin_index_table_instructors')}}</th>
                    <th scope="col">{{__('lesson.admin_index_table_danceStyle')}}</th>
                    <th scope="col">{{__('lesson.admin_index_table_difficulty')}}</th>
                    <th scope="col">{{__('lesson.admin_index_table_signups')}}</th>
                    <th scope="col">{{__('lesson.admin_index_table_functions')}}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($lessons as $lesson)
                    @php($registrationsCount = $lesson->registrations()->where('is_active', '=', true)->count())
                    @if(!$lesson->can_signup || !$lesson->visible)
                        <tr class="table-info" data-url="{{route('admin.lesson.show', ['id' => $lesson->id])}}">
                    @elseif($registrationsCount == $lesson->total_signup_space )
                        <tr class="table-danger" data-url="{{route('admin.lesson.show', ['id' => $lesson->id])}}">
                    @elseif(($registrationsCount+2) >= $lesson->total_signup_space )
                        <tr class="table-warning" data-url="{{route('admin.lesson.show', ['id' => $lesson->id])}}">
                    @else
                        <tr data-url="{{route('admin.lesson.show', ['id' => $lesson->id])}}">
                            @endif
                            <td scope="row">{{$lesson->name}}</td>
                            <td>{{$lesson->age_min}}</td>
                            <td>{{$lesson->age_max}}</td>
                            <td>
                                @foreach($lesson->instructors as $instrcutor)
                                    {{$instrcutor->user->name}} <br>
                                @endforeach
                            </td>
                            <td>{{$lesson->danceStyle->name}}</td>
                            <td>{{$lesson->difficulty->name}}</td>
                            <td>
                                <a class=""
                                   href="{{route('admin.signups.lessonIndex', [$lesson->id])}}">{{$registrationsCount}}
                                    / {{$lesson->total_signup_space}}</a>
                            </td>
                            <td>
                                <div class="container">
                                    @can('admin_panel')
                                        <form method="POST"
                                              action="{{route('admin.lesson.remove', [$lesson->id])}}"
                                              onsubmit="return confirm('{{__('lesson.admin_index_button_confirmDelete', ['lessonName' => $lesson->name])}}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger">{{__('lesson.admin_index_button_delete')}}</button>
                                        </form>
                                    @endcan
                                    <a class="btn btn-primary"
                                       href="{{route('admin.lesson.edit', [$lesson->id])}}">{{__('lesson.admin_index_button_edit')}}</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
