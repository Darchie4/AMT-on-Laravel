@php use App\Models\Lesson;use App\Models\Registration; @endphp
@extends('layouts.admin')

@section('head')
    <script src="{{ asset('js/admin/lesson/clickableRowsInTable.js') }}"></script>
@endsection

@section('admin_content')
    @include('partials._systemFeedback')
    <div class="container">
        <div class="mb-5 text-center">
            <h2>{{__('lesson.admin_index_welcome')}}</h2>
        </div>
        <div class="row">
            <div class="col mb-2">
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
            @can('lessons_crud')
                <div class="flex-sm-column d-sm-flex justify-content-sm-end col-md-3 mb-2">
                    <a class="btn btn-primary mb-2 w-100 fs-5" role="button"
                       href="{{route('admin.lesson.create')}}">{{__('lesson.admin_index_create_new')}}</a>
                </div>
            @endcan
        </div>

        <div class="table-responsive">
            <table class="table table-bordered border-primary">
                <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
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
                    @if($registrationsCount == $lesson->total_signup_space )
                        <tr class="table-danger" data-url="{{route('admin.lesson.show', ['id' => $lesson->id])}}">
                    @elseif(($registrationsCount+2) >= $lesson->total_signup_space  && !($lesson->total_signup_space <= 2))
                        <tr class="table-warning" data-url="{{route('admin.lesson.show', ['id' => $lesson->id])}}">
                    @elseif(!$lesson->can_signup || !$lesson->visible)
                        <tr data-url="{{route('admin.lesson.show', ['id' => $lesson->id])}}">
                    @else
                        <tr class="table-info" data-url="{{route('admin.lesson.show', ['id' => $lesson->id])}}">
                    @endif
                            <td>{{$lesson->id}}</td>
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
                            <td class="bg-white">
                                <a class=" btn btn-outline-primary"
                                   href="{{route('admin.lesson.edit', [$lesson->id])}}">{{__('lesson.admin_index_button_edit')}}</a>
                            @can('admin_panel')
                                    <form class="d-inline-flex"
                                                  method="POST"
                                                  action="{{route('admin.lesson.remove', [$lesson->id])}}"
                                                  onsubmit="return confirm('{{__('lesson.admin_index_button_confirmDelete', ['lessonName' => $lesson->name])}}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger">{{__('lesson.admin_index_button_delete')}}</button>
                                            </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
