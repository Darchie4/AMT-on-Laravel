@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h2>{{__('customLabels.permissions')}}</h2>
        <div class="d-grid d-md-flex"><br>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="{{route('admin.roles.index')}}">{{__('customLabels.roles')}}</a>
        </div>
        <div class="row justify-content-center">
            <div class="card">
                <form method="POST" action="{{route('admin.permissions.update',$permission)}}">
                    @csrf
                    @method('PUT')
                    <label for="name">{{__('customLabels.permission_name')}}</label>
                    <input type="text" name="name" value="{{$permission->name}}" required
                           @error('name') is-invalid @enderror>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <button type="submit" class="btn btn-success mb-2 mt-2 px-3">{{__('customLabels.edit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
