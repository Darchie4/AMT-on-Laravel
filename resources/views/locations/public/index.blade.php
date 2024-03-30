@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-2 text-center">
            <h1>{{__('location.public_index_welcome')}}</h1>
            <p>{!! __('location.public_index_subtitle') !!}</p>
        </div>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($locations as $location)
                <div class="col">
                    <div class="card w-100">
                        <div class="card-header text-center">
                            <h4 class="card-title text-primary mx-auto">{{$location->name}}</h4>
                        </div>
                        <div class="text-center mt-3">
                            @if(isset($location->cover_img_path))

                                <img src="{{asset($location->cover_img_path)}}"
                                     class="img-fluid rounded"
                                     style="height: 200px"
                                     alt="{{__('location.public_index_alt_image_text')}} {{$location->name}}">
                            @else
                                <img src="{{asset('no_image.jpg')}}"
                                     class="img-fluid rounded"
                                     style="height: 200px"
                                     alt="{{__('location.cover_img_alt')}} {{$location->name}}">
                            @endif
                        </div>
                        <div class="card-body">
                            <div>
                                <h5 class="text-secondary">{{__('location.public_index_short_description')}}</h5>
                                {{$location->short_description}}
                            </div>
                            <div class="mt-1">
                                <p class="text-secondary">{{__('location.public_index_city')}}: {{($location->address->city)}}</p>
                            </div>
                        </div>

                        <div class="card-body my-0">
                            <div class="text-center">
                                <a class="m-auto btn btn-primary px-5"
                                   href="{{route('locations.public.show', ['id' => $location->id])}}">{{__('location.public_index_show_details')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
