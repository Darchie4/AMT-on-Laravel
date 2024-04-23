@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <!--All users button-->
        <div class="d-grid d-md-flex gap-2"><br>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="{{route('admin.users.index')}}">{{__('customLabels.all_users')}}</a>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="javascript:history.back()">{{__('customLabels.back')}}</a>
        </div>

        <div class="row justify-content-md-center">
            <!--General user info-->
            <div class="card">
                <div class="card-header">
                    {{__('customLabels.users')}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.users.update',$user->id)}}">
                        @csrf
                        @method('PUT')
                        <p class="card-text">

                            @include('partials._userInfoInput')
                            @include('partials._addressInput',['addressOld' => $user->address])
                        <button type="submit"
                                class="btn btn-success mb-2 mt-2 px-3">{{__('customLabels.edit')}}</button>
                    </form>
                </div>
            </div>
            <hr>
            <!--Role management-->
            <div class="card">
                <div class="card-header">
                    {{__('customLabels.roles')}}
                </div>
                <div class="card-body">
                    <!--See roles-->
                    <ul>
                        @if($user->roles)
                            @foreach($user->roles as $user_role)
                                <form method="POST"
                                      action="{{route('admin.users.roles.remove', [$user->id,$user_role->id])}}"
                                      onsubmit="return confirm('{{__('role.confirm_delete_role')}}')">
                                    @csrf
                                    @method('DELETE')
                                    <li>
                                        <button type="submit" class="btn btn-outline-primary">{{$user_role->name}}</button>
                                    </li>
                                </form>
                            @endforeach
                        @endif

                    </ul>
                    <!--Assign roles-->
                    <form method="POST" action="{{route('admin.users.roles.assign',$user->id)}}">
                        @csrf
                        <label for="role">{{__('customLabels.role_name')}}</label>
                        <select type="text" class="form-select" id="role" name="role">
                            @foreach($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                        <button type="submit"
                                class="btn btn-success mb-2 mt-2 px-3">{{__('customLabels.assign')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
