@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-5 text-center">
            <h1>{{__('customlabels.lesson_index_welcome')}}</h1>
        </div>
        <div class="my-5 row g2">
            <div class="col">
            </div>
                <div class="col">
                </div>
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
                </tr>
                </thead>

                <tbody>
                @foreach($lessons as $lesson)
                    <tr>
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
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
