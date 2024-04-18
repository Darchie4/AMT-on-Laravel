@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h1>{{count($users)>1 ? __('registration.admin_moveMultiple_title') : __('registration.admin_moveSingle_title')}}</h1>

        <div class="container mt-5 row row-cols-3">
            <div class="col">
                <h3>{{count($users)>1 ? __('registration.admin_moveMultiple_moveFrom') : __('registration.admin_moveSingle_moveFrom')}}</h3>
                {{$fromLesson->name}}
            </div>

            <div class="col my-3">
                <h3>{{count($users)>1 ? __('registration.admin_moveMultiple_selectedUsers') : __('registration.admin_moveSingle_selectedUser')}}</h3>
                <ul>
                    @foreach($users as $user)
                        <li>{{$user->name}} {{$user->lname}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col">
                <form action="{{route("admin.registrations.DoMove")}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="fromLessonId" value="{{$fromLesson->id}}" hidden/>
                    <input type="hidden" name="users" value="{{ implode(',', array_map(function($user) {
                            return $user->id;
                        }, $users)) }}
                    ">

                    <label for="toLesson">{{__('registration.admin_move_newLesson')}}</label><br>
                    <input class="form-control" name="toLesson" list="toLessons"
                           placeholder="{{__('registration.admin_move_placeholder_newLesson')}}" required><br>
                    <datalist id="toLessons">
                        @foreach($lessons as $lesson)
                            @if($lesson->id == $fromLesson->id)
                                <option value="{{$lesson->name}}"
                                        title="{{__('registrations.admin_move_lessonIsSame')}}"
                                        disabled>{{$lesson->name}}</option>
                            @elseif(!(($lesson->registrations()->count() + count($users) <= $lesson->total_signup_space)))
                                <option value="{{$lesson->name}}"
                                        title="{{__('registrations.admin_move_lessonTooFull')}}"
                                        disabled>{{$lesson->name}}</option>
                            @else
                                <option value="{{$lesson->id}}">{{$lesson->name}}</option>
                            @endif
                        @endforeach
                    </datalist>
                    <button class="form-control btn btn-primary"
                            type="submit">{{count($users)>1 ? __('registration.admin_moveMultiple_confirmMove') : __('registration.admin_moveSingle_confirmMove')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
