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
                    </ul>
                </aside>
            </div>

            <div class="col-md-10">
                @yield('admin_content')
            </div>
        </div>
    </div>

@endsection
