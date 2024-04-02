@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <aside class="bd-sidebar">
                    <h3>Administration</h3>
                    <ul>
                        @can('roles_crud')
                            <li>
                                <a href="{{ route('admin.roles.index') }}">{{ __('customLabels.roles') }}</a>
                            </li>
                        @endcan
                        @can('permissions_crud')
                            <li>
                                <a href="{{ route('admin.permissions.index') }}">{{ __('customLabels.permissions') }}</a>
                            </li>
                        @endcan
                        @can('users_crud')
                            <li>
                                <a href="{{ route('admin.users.index') }}">{{ __('customLabels.users') }}</a>
                            </li>
                        @endcan
                        @can(['instructors_crud','instructors_own'])

                            <li>
                                <a href="{{ route('admin.instructors.index') }}">{{ __('customLabels.instructors') }}</a>
                            </li>
                        @endcan
                        @can(['lessons_crud','lessons_own'])
                            <li>
                                <a href="{{ route('admin.lesson.index') }}">{{ __('customLabels.lesson_index_lessons') }}</a>
                            </li>
                        @endcan
                        @can('locations_crud')
                            <li>
                                <a href="{{ route('admin.locations.index') }}">{{ __('location.location_index_admin') }}</a>
                            </li>
                        @endcan
                    </ul>
                </aside>
            </div>

            <div class="col-md-10">
                @yield('admin_content')
            </div>
        </div>
    </div>

@endsection
