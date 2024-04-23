@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h2>{{__('permission.admin_index_title')}}</h2>
        <div class="row justify-content-center">
            <div>
                <table class="table table-bordered border-primary">
                    <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('permission.permission_name')}}</th>
                        <th scope="col">{{__('permission.admin_index_manage')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>
                                <a role="button" class="btn btn-outline-primary" href="{{route('admin.permissions.edit', $permission->id)}}">{{__('permission.admin_index_rename')}}</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection


