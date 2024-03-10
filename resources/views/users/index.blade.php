@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h2>{{__('customLabels.users')}}</h2>
        <div class="row row-cols-2">
            <!--Search box -->
            <div class="d-grid justify-content-md-start mb-2 col-md-9">
                <form>
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
            <div class="row row-cols-2 col-md-3">
                <!--Filter dropdown-->
                <div class="d-grid justify-content-md-end">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary" type="button" id="filterDropdownButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter"></i>
                        </button>
                        <!--INSERT FORM HERE-->
                    </div>
                </div>
                <!--Create new btn-->
                <div class="d-grid justify-content-md-start mb-3"><br>
                    <a class="btn btn-outline-primary" role="button"
                       href="{{route('admin.users.create')}}">{{__('customLabels.create')}}</a>
                </div>
            </div>
        </div>
        <!--User table-->
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
                            <td><a href="#">{{$user->email}}</a></td>
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
                                    <button type="submit" class="btn btn-danger">{{__('customLabels.delete')}}</button>
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
