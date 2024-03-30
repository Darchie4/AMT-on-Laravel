@extends('layouts.app')

@section('content')
    <div class="container">
        <!--All locations button + back-->
        <div class="d-grid d-md-flex gap-2"><br>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="{{route('locations.public.index')}}">{{__('location.public_show_all_locations')}}</a>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="javascript:history.back()">{{__('navigation.back')}}</a>
        </div>
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mx-auto">{{$location->name}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-2">
                            <div class="col-md-4 card-body">

                                <div class="mb-2">
                                    <p class="text-secondary">{{__('location.public_show_address')}}
                                        : {{$location->address->street_name}} {{$location->address->street_number}},
                                        {{$location->address->zip_code}} {{$location->address->city}}</p>

                                </div>
                                <h5 class="text-secondary">{{__('location.public_show_long_description')}}</h5>
                                {!!$location->long_description!!}
                            </div>
                            <div class="col-md-6 justify-content-center">
                                <div>
                                    <div class="text-center" id="map">
                                        <?php
                                        include_once(app_path('Http/UrlSigner.php'));

                                        $apikey = env('GOOGLE_API_KEY');
                                        $signature = env('GOOGLE_SIGNATURE');

                                        $address = urlencode("{$location->address->street_number} {$location->address->street_name}, {$location->address->city}, {$location->address->country}");

                                        $mapURL = "https://maps.googleapis.com/maps/api/staticmap?center={$address}&markers={$address}&zoom=17&size=400x400&key={$apikey}";

                                        $signedMapURL = signUrl($mapURL, $signature);
                                        ?>

                                        <img class="img-fluid rounded" src="<?php echo $signedMapURL; ?>" alt="Map">

                                    </div>
                                    <div class="text-center mt-3">
                                        @if(isset($location->cover_img_path))

                                        <img src="{{asset($location->cover_img_path)}}"
                                             class="img-fluid rounded"
                                             style="height: 400px"
                                             alt="{{__('location.cover_img_alt')}} {{$location->name}}">
                                        @else
                                            <img src="{{asset('no_image.jpg')}}"
                                                 class="img-fluid rounded"
                                                 style="height: 400px"
                                                 alt="{{__('location.cover_img_alt')}} {{$location->name}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
