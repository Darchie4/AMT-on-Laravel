@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-5 text-center">
            <h1>{{__('customlabels.lesson_index_welcome')}}</h1>
        </div>
        <div class="my-5 row g2">
            <div class="col">
                <h2>{{__('customlabels.lesson_index_statistics_tittle')}}</h2>
                <b>{{__('customlabels.lesson_index_statistics_lesson_count')}}: </b> {{$lessons->count()}}
            </div>
            @can('admin_panel')
                <div class="col">
                    <h2>{{__('customlabels.lesson_index_links')}}</h2>
                    <a class="btn btn-primary"
                       href="{{route('admin.lesson.create')}}">{{__('customlabels.lesson_index_create_new')}}</a>
                </div>
            @endcan
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">{{__('customlabels.lesson_index_table_name')}}</th>
                        <th scope="col">{{__('customlabels.lesson_index_table_age_min')}}</th>
                        <th scope="col">{{__('customlabels.lesson_index_table_age_max')}}</th>
                        <th scope="col">{{__('customlabels.lesson_index_table_instructors')}}</th>
                        <th scope="col">{{__('customlabels.lesson_index_table_danceStyle')}}</th>
                        <th scope="col">{{__('customlabels.lesson_index_table_difficulty')}}</th>
                        <th scope="col">{{__('customlabels.lesson_index_table_signups')}}</th>
                        <th scope="col">{{__('customlabels.lesson_index_table_functions')}}</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($lessons as $lesson)
                    @php($registrationsCount = $lesson->registrations()->where('is_active', '=', true)->count())
                    @if(!$lesson->can_signup || !$lesson->visible)
                        <tr class="table-info">
                    @elseif($registrationsCount == $lesson->total_signup_space )
                        <tr class="table-danger">
                    @elseif(($registrationsCount+2) >= $lesson->total_signup_space )
                        <tr class="table-warning">
                    @else
                        <tr>
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
                               href="{{route('admin.signups.lessonIndex', [$lesson->id])}}">{{$registrationsCount}} / {{$lesson->total_signup_space}}</a>
                        </td>
                        <td>
                            <div class="container">
                                @can('admin_panel')
                                    <form method="POST"
                                          action="{{route('admin.lesson.remove', [$lesson->id])}}"
                                          onsubmit="return confirm('{{__('customLabels.confirm')}}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger">{{__('customLabels.lesson_index_button_delete')}}</button>
                                    </form>
                                @endcan
                                <a class="btn btn-primary"
                                   href="{{route('admin.lesson.edit', [$lesson->id])}}">{{__('customLabels.edit')}}</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
