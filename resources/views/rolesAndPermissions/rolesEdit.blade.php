@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h2>{{__('customLabels.roles')}}</h2>
        <div class="d-grid d-md-flex"><br>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="{{route('admin.roles.index')}}">{{__('customLabels.roles')}}</a>
        </div>
        <div class="row justify-content-center">
            <div class="card">
                <form method="POST" action="{{route('admin.roles.update',$role)}}">
                    @csrf
                    @method('PUT')
                    <label for="name">{{__('customLabels.role_name')}}</label>
                    <input type="text" name="name" value="{{$role->name}}" required @error('name') is-invalid @enderror>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <button type="submit" class="btn btn-success mb-2 mt-2 px-3">{{__('customLabels.edit')}}</button>
                </form>
            </div>
            <div class="card">
                <p>Current permissions for role:</p>
                <ul>
                        @if($role->permissions)
                            @foreach($role->permissions as $role_permission)
                                <form method="POST"
                                      action="{{route('admin.roles.permission.remove', [$role->id,$role_permission->id])}}"
                                      onsubmit="return confirm('{{__('customLabels.confirm')}}')">
                                    @csrf
                                    @method('DELETE')
                                    <li>
                                        <button type="submit" class="btn btn-link">{{$role_permission->name}}</button>
                                    </li>
                                </form>
                            @endforeach
                        @endif

                </ul>
                <form method="POST" action="{{route('admin.roles.permission.assign',$role->id)}}">
                    @csrf
                    <label for="permission">{{__('customLabels.role_name')}}</label>
                    <select type="text" name="permission" autocomplete="permission-name">
                        @foreach($permissions as $permission)
                            <option value="{{$permission->name}}">{{$permission->name}}</option>
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
