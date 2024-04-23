@extends('layouts.admin')

@section('admin_content')
    @include('partials._systemFeedback')

    <div class="container">
        <h2>{{__('customLabels.roles')}}</h2>
        <div class="d-grid d-md-flex justify-content-md-end"> <br>
            <a class="btn btn-outline-primary mb-2" role="button" href="{{route('admin.roles.create')}}">{{__('customLabels.create')}}</a>
        </div>
        <div class="row justify-content-center">
            <div>
                <table class="table table-bordered border-primary">
                    <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('customLabels.role_name')}}</th>
                        <th scope="col">{{__('customLabels.manage')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <a role="button" class="btn btn-outline-primary" href="{{route('admin.roles.edit', $role->id)}}">{{__('customLabels.edit')}}</a>
                                <form class="d-inline-flex" method="post" action="{{route('admin.roles.destroy',$role->id)}}"
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
