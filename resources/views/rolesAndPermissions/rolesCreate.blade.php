@extends('layouts.admin')

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
                <input type="text" name="name" required @error('name') is-invalid @enderror>
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <button type="submit" class="btn btn-success px-3">{{__('customLabels.create')}}</button>
            </form>
        </div>
    </div>
@endsection
