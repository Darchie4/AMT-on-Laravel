@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h2>{{__('customLabels.permissions')}}</h2>
        <div class="d-grid d-md-flex justify-content-md-end"> <br>
            <a class="btn btn-outline-primary mb-2" role="button" href="{{route('admin.permissions.create')}}">{{__('customLabels.create')}}</a>
        </div>
        <div class="row justify-content-center">
            <div>
                <table class="table table-bordered border-primary">
                    <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('customLabels.permission_name')}}</th>
                        <th scope="col">{{__('customLabels.manage')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>
                                <a href="{{route('admin.permissions.edit', $permission->id)}}">{{__('customLabels.edit')}}</a>
                                <a href="#">{{__('customLabels.delete')}}</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection


