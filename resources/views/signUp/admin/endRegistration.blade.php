@extends('layouts.admin')

@section('admin_content')

    <div class="container">
        <form action="{{route("admin.registrations.doEnd")}}" method="post"
              enctype="multipart/form-data">
            @csrf
            <input name="lessonId" value="{{$lesson->id}}" hidden>
            <input type="hidden" name="users" value="{{ implode(',', array_map(function($user) {
                            return $user->id;
                        }, $users)) }}
                    ">
            <h1>{{__('registration.admin_delete_confirm_title')}}</h1>

            <div class="row row-cols-3">
                <div class="col">
                    <h3>{{__('registration.admin_delete_confirm_lesson')}}</h3>
                    {{$lesson->name}}
                </div>
                <div class="col">
                    <h3>{{__('registration.admin_delete_confirm_users')}}</h3>
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>{{__('registration.admin_delete_confirm_user_name')}}</th>
                            <th>{{__('registration.admin_delete_confirm_user_email')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th>{{$user->name}} {{$user->lname}}</th>
                                <th>{{$user->email}}</th>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="col">
                    <h3>{{__('registration.admin_delete_confirm_sure')}}</h3>
                    <button
                        class="form-control btn btn-danger">{{__('registration.admin_delete_confirm_submit')}}</button>
                </div>
            </div>
        </form>

    </div>

@endsection
