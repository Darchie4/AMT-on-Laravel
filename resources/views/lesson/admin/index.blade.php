@extends('layouts.app')

@section('content')
    <div class="container">
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Min. age</th>
                <th>Max. age</th>
                <th>Instructors</th>
                <th>Dance style</th>
                <th>Difficulty</th>
            </tr>
            </thead>
            <tbody>

            @foreach($lessons as $lesson)
                <tr>
                    <td>{{$lesson->name}}</td>
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

            <tr>
            </tr>
            </tbody>
        </table>
    </div>


@endsection
