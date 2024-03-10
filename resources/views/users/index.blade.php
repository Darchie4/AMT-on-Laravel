@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h2>{{__('customLabels.users')}}</h2>
        <div class="d-grid d-md-flex justify-content-md-end"> <br>
            <a class="btn btn-outline-primary mb-2" role="button" href="{{route('admin.users.create')}}">{{__('customLabels.create')}}</a>
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
                            <td><a href="#">{{$user->email}}</a></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->lname}}</td>
                            <td>
                                <a role="button" class="btn btn-outline-primary" href="{{route('admin.users.edit', $user->id)}}">{{__('customLabels.edit')}}</a>
                                <form class="d-inline-flex" method="post" action="{{route('admin.users.destroy',$user->id)}}"
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
