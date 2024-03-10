@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h2>{{__('customLabels.users')}}</h2>
        <div class="d-grid d-md-flex"><br>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="{{route('admin.users.index')}}">{{__('customLabels.all_users')}}</a>
        </div>
        <div class="row justify-content-center">
            <div class="card">
                <form method="POST" action="{{route('admin.users.update',$user)}}">
                    @csrf
                    @method('PUT')
                    <label for="name">{{__('customLabels.firstname')}}</label>
                    <input type="text" name="name" value="{{$user->name}}" required @error('name') is-invalid @enderror>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <button type="submit" class="btn btn-success mb-2 mt-2 px-3">{{__('customLabels.edit')}}</button>
                </form>
            </div>
            <div class="card">
                <p>Current roles for user:</p>
                <ul>
                    @if($user->roles)
                        @foreach($user->roles as $user_role)
                            <form method="POST"
                                  action="{{route('admin.users.roles.remove', [$user->id,$user_role->id])}}"
                                  onsubmit="return confirm('{{__('customLabels.confirm')}}')">
                                @csrf
                                @method('DELETE')
                                <li>
                                    <button type="submit" class="btn btn-link">{{$user_role->name}}</button>
                                </li>
                            </form>
                        @endforeach
                    @endif

                </ul>
                <form method="POST" action="{{route('admin.users.roles.assign',$user->id)}}">
                    @csrf
                    <label for="role">{{__('customLabels.role_name')}}</label>
                    <select type="text" name="role" autocomplete="role-name">
                        @foreach($roles as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button type="submit" class="btn btn-success mb-2 mt-2 px-3">{{__('customLabels.assign')}}</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
