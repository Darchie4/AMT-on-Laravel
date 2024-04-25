@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h2 class="text-center mb-5">{{__('customLabels.users')}}</h2>
        <div class="row row-cols-2">
            <!--Search box -->
            <div class="d-grid justify-content-md-start mb-2 col-md-8">
                <form action="{{route('admin.users.index')}}" method="GET">
                    <div class="input-group">
                        <input class="form-control"
                               type="search"
                               placeholder="{{__('customLabels.users_search_here')}}"
                               name="search"
                               id="usertable-search-input"
                               value="{{request('search')}}"/>
                        <span class="input-group-text">
                            <button class="btn btn-sm p-1" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            <!--Filter and create new-->
            <div class="d-grid d-md-flex justify-content-md-end col-md-4 mb-2">
                <!--Filter dropdown-->
                <div class="me-md-2">
                    <div class="dropdown">
                        <button class="btn btn-primary fs-5" type="button" id="filterDropdownButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter"></i>
                        </button>
                        <form action="{{ route('admin.users.filter') }}" method="POST" id="filter_form">
                            @csrf
                            <ul class="dropdown-menu">
                                @foreach($roles as $role)
                                    <li class="dropdown-item-text">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="roles[]"
                                                   value="{{ $role->name }}"
                                                   id="{{ $role->name }}"{{ in_array($role->name, $selectedRoles) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{ $role->name }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                                <li class="dropdown-item-text">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </li>
                                <li class="dropdown-item-text">
                                    <button type="button" class="btn btn-secondary" onclick="clearFilters()">Reset
                                        Filters
                                    </button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
                <!--Create new btn-->
                <div class="w-75">
                    <a class="btn btn-primary w-100 fs-5" role="button"
                       href="{{route('admin.users.create')}}">{{__('customLabels.create')}}</a>
                </div>
            </div>
        </div>

            <div class="row justify-content-center">
                <div>
                    <table class="table table-bordered border-primary">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('customLabels.email')}}</th>
                            <th scope="col">{{__('customLabels.firstname')}}</th>
                            <th scope="col">{{__('customLabels.lastname')}}</th>
                            <th scope="col">{{__('customLabels.manage')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td><a href="{{route('admin.users.show',$user->id)}}">{{$user->email}}</a></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->lname}}</td>
                                <td>
                                    <a role="button" class="btn btn-outline-primary"
                                       href="{{route('admin.users.edit', $user->id)}}">{{__('customLabels.edit')}}</a>
                                    <form class="d-inline-flex" method="post"
                                          action="{{route('admin.users.destroy',$user->id)}}"
                                          onsubmit="return confirm('{{__('customLabels.confirm')}}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger">{{__('customLabels.delete')}}</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
@endsection
