@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="my-2 text-center">
            <h1>{{__('instructor.public_index_welcome')}}</h1>
            <p>{!! __('instructor.public_index_subtitle') !!}</p>
        </div>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($instructors as $instructor)
                <div class="col">
                    <div class="card w-100">
                        <div class="card-header text-center">
                            <h4 class="card-title text-primary mx-auto">{{$instructor->user->name}} {{$instructor->user->lname}}</h4>
                        </div>
                        <img src="{{asset($instructor->profile_img_path)}}" class="card-img"
                             alt="{{__('instructor.public_index_alt_image_text')}} {{$instructor->user->name}}">
                        <div class="card-body my-0">
                            <h5 class="text-secondary">{{__('instructor.public_index_short_description')}}</h5>
                            {{$instructor->short_description}}
                        </div>
                        <div class="card-body my-0">
                            <div class="text-center">
                                <a class="m-auto btn btn-primary px-5"
                                   href="{{route('admin.instructors.show', ['id' => $instructor->id])}}">{{__('instructor.public_index_show_details')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
