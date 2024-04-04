@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h2>{{__('location.public_show_all_locations')}}</h2>
        <div class="row row-cols-2">
            <!--Search box -->
            <div class="d-grid justify-content-md-start mb-2 col-md-9">
                <form action="{{route('admin.locations.index')}}" method="GET">
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
            <!--Create new btn-->
            <div class="d-grid justify-content-md-end col-md-2 mb-2"><br>
                <a class="btn btn-outline-primary mb-2" role="button"
                   href="{{route('admin.locations.create')}}">{{__('customLabels.create')}}</a>
            </div>
        </div>

        <!--Instructor table-->
        <div class="row justify-content-center">
            <div>
                <table class="table table-bordered border-primary">
                    <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('location.name')}}</th>
                        <th scope="col">{{__('address.city')}}</th>
                        <th scope="col">{{__('customLabels.manage')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td>{{$location->id}}</td>
                            <td>
                                <a href="{{route('locations.public.show',$location->id)}}">{{$location->name}}</a>
                            </td>
                            <td>
                                <p>{{$location->address->city}}</p>
                            </td>

                            <td>
                                <a role="button" class="btn btn-outline-primary"
                                   href="{{route('admin.locations.edit', $location->id)}}">{{__('customLabels.edit')}}</a>
                                <form class="d-inline-flex" method="post"
                                      action="{{route('admin.locations.destroy',$location->id)}}"
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
