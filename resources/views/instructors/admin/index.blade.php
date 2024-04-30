@extends('layouts.admin')

@section('admin_content')
    @include('partials._systemFeedback')

    <div class="container">
        <h2 class="text-center mb-5">{{__('customLabels.instructor_index_instructors')}}</h2>
        <div class="row row-cols-2">
            <!--Search box -->
            <div class="d-grid justify-content-md-start mb-2 col-md-9">
                <form action="{{route('admin.instructors.index')}}" method="GET">
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
            @can('instructors_crud')
            <!--Create new btn-->
            <div class="d-grid d-md-flex justify-content-md-end col-md-3 mb-2 ">
                <a class="btn btn-primary mb-2 w-100 fs-5" role="button"
                   href="{{route('admin.instructors.create')}}">{{__('customLabels.create')}}</a>
            </div>
            @endcan
        </div>

        <!--Instructor table-->
        <div class="row justify-content-center">
            <div class="table-responsive">
                <table class="table table-bordered border-primary">
                    <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('customLabels.email')}}</th>
                        <th scope="col">{{__('customLabels.firstname')}}</th>
                        <th scope="col">{{__('customLabels.lastname')}}</th>
                        <th scope="col">{{__('customLabels.instructor_index_lessons')}}</th>
                        <th scope="col">{{__('customLabels.manage')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($instructors as $instructor)
                        <tr>
                            <td>{{$instructor->user->id}}</td>
                            <td>
                                <a href="{{route('admin.instructors.show',$instructor->id)}}">{{$instructor->user->email}}</a>
                            </td>
                            <td>{{$instructor->user->name}}</td>
                            <td>{{$instructor->user->lname}}</td>
                            <td>
                        @foreach($instructor->lessons as $lesson)
                                <a href="{{route('admin.lesson.show',$lesson->id)}}" data-bs-toggle="tooltip" title="{{$lesson->name}}">{{$lesson->id}}</a>{{($loop->last ? '' : ', ')}}
                            @endforeach
                            </td>

                            <td>

                                <a role="button" class="btn btn-outline-primary mb-2"
                                   href="{{route('admin.instructors.edit', $instructor->id)}}">{{__('customLabels.edit')}}</a>
                                @can('instructors_crud')
                                <form class="d-inline-flex" method="post"
                                      action="{{route('admin.instructors.destroy',$instructor->id)}}"
                                      onsubmit="return confirm('{{__('customLabels.confirm')}}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{__('customLabels.delete')}}</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
