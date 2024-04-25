@extends('layouts.admin')
@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

    <script>
        $(document).ready(function () {
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
            });
        });
    </script>
@endsection
@section('admin_content')
    @include('partials._systemFeedback')

    <div class="container">
        <h2>{{__('customLabels.roles')}}</h2>
        <div class="d-grid d-md-flex"><br>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="{{route('admin.roles.index')}}">{{__('customLabels.roles')}}</a>
        </div>
        <div class="row justify-content-center">
            <form method="POST" action="{{route('admin.roles.store')}}">
                @csrf
                <label for="name">{{__('customLabels.role_name')}}</label>
                <input type="text" name="name" id="name" class="form-control mb-2" required @error('name') is-invalid @enderror>
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <label for="permissions[]">{{__('customLabels.permissions')}}</label>
                <select class="form-select mb-2" name="permissions[]" multiple
                        id="choices-multiple-remove-button">
                    @foreach($permissions as $permission)
                        <option value="{{$permission->name}}">{{$permission->name}}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-success px-3">{{__('customLabels.create')}}</button>
            </form>
        </div>
    </div>
@endsection
