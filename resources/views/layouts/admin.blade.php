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
                        @canany('roles_crud')
                            <a class="list-group-item border-end-0 d-inline-block text-truncate
                            @if(request()->routeIs('admin.roles.*')) active @endif"
                               data-bs-parent="#sidebar" href="{{ route('admin.roles.index') }}"
                            >
                                {{ __('navigation.roles') }}
                            </a>
                        @endcanany
                        @canany('permissions_crud')
                            <a class="@if(request()->routeIs('admin.permissions.*')) active @endif
                            list-group-item border-end-0 d-inline-block text-truncate"
                                data-bs-parent="#sidebar" href="{{ route('admin.permissions.index') }}">
                                {{ __('navigation.permissions') }}
                            </a>
                        @endcanany
                        @canany('users_crud')
                            <a class="@if(request()->routeIs('admin.users.*')) active @endif
                            list-group-item border-end-0 d-inline-block text-truncate"
                                data-bs-parent="#sidebar" href="{{ route('admin.users.index') }}">
                               {{ __('navigation.users') }}
                            </a>
                        @endcanany
                        @canany(['instructors_crud','instructors_own'])

                            <a class="@if(request()->routeIs('admin.instructors.*')) active @endif
                            list-group-item border-end-0 d-inline-block text-truncate"
                                data-bs-parent="#sidebar" href="{{ route('admin.instructors.index') }}">
                                {{ __('navigation.instructors') }}
                            </a>
                        @endcanany
                        @canany(['lessons_crud','lessons_own'])
                            <a class="@if(request()->routeIs('admin.lesson.*')) active @endif
                            list-group-item border-end-0 d-inline-block text-truncate"
                                data-bs-parent="#sidebar" href="{{ route('admin.lesson.index') }}">
                                {{ __('navigation.lessons') }}
                            </a>
                        @endcanany
                        @canany('locations_crud')
                            <a class="@if(request()->routeIs('admin.locations.*')) active @endif
                            list-group-item border-end-0 d-inline-block text-truncate"
                                data-bs-parent="#sidebar" href="{{ route('admin.locations.index') }}">
                                {{ __('navigation.locations') }}
                            </a>
                        @endcanany
                        @canany('pricing_crud')
                            <a class="@if(request()->routeIs('admin.pricing.*')) active @endif
                            list-group-item border-end-0 d-inline-block text-truncate"
                               data-bs-parent="#sidebar" href="{{ route('admin.pricing.index') }}">
                                {{ __('navigation.pricing') }}
                            </a>
                        @endcanany
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
