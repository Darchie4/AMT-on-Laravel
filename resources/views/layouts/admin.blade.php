@extends('layouts.app')

@section('nav-content')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto px-sm-2 px-0">
                <div class="collapse collapse-horizontal show border-end" id="sidebar">
                    <div class="list-group text-sm-start min-vh-100" style="width: 180px">
                        <a class="list-group-item border-end-0 d-inline-block text-truncate"
                           data-bs-parent="#sidebar">
                            <span class="fw-bolder">Administration</span>
                        </a>
                        @can('roles_crud')
                            <a class="list-group-item border-end-0 d-inline-block text-truncate"
                               data-bs-parent="#sidebar" href="{{ route('admin.roles.index') }}">
                                {{ __('navigation.roles') }}
                            </a>
                        @endcan
                        @can('permissions_crud')
                            <a class="list-group-item border-end-0 d-inline-block text-truncate"
                                data-bs-parent="#sidebar" href="{{ route('admin.permissions.index') }}">
                                {{ __('navigation.permissions') }}
                            </a>
                        @endcan
                        @can('users_crud')
                            <a class="list-group-item border-end-0 d-inline-block text-truncate"
                                data-bs-parent="#sidebar" href="{{ route('admin.users.index') }}">
                               {{ __('navigation.users') }}
                            </a>
                        @endcan
                        @can(['instructors_crud','instructors_own'])

                            <a class="list-group-item border-end-0 d-inline-block text-truncate"
                                data-bs-parent="#sidebar" href="{{ route('admin.instructors.index') }}">
                                {{ __('navigation.instructors') }}
                            </a>
                        @endcan
                        @can(['lessons_crud','lessons_own'])
                            <a class="list-group-item border-end-0 d-inline-block text-truncate"
                                data-bs-parent="#sidebar" href="{{ route('admin.lesson.index') }}">
                                {{ __('navigation.lessons') }}
                            </a>
                        @endcan
                        @can('locations_crud')
                            <a class="list-group-item border-end-0 d-inline-block text-truncate"
                                data-bs-parent="#sidebar" href="{{ route('admin.locations.index') }}">
                                {{ __('navigation.locations') }}
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <main class="col ps-md-2 pt-2">
                <button type="button" data-bs-target="#sidebar" data-bs-toggle="collapse"
                   class="navbar-toggler">
                    <i class="fa fa-bars pt-1">
                    </i>
                </button>
                @yield('admin_content')
            </main>
        </div>
    </div>

@endsection
