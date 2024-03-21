@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <aside class="bd-sidebar">
                    <h3>Administration</h3>
                    <ul>
                        <li>
                            <a href="{{ route('admin.roles.index') }}">{{ __('customLabels.roles') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.permissions.index') }}">{{ __('customLabels.permissions') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}">{{ __('customLabels.users') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.instructors.index') }}">{{ __('customLabels.instructors') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.lesson.index') }}">{{ __('customLabels.lesson_index_lessons') }}</a>
                        </li>
                    </ul>
                </aside>
            </div>

            <div class="col-md-10">
                @yield('admin_content')
            </div>
        </div>
    </div>

@endsection
