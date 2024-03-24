@extends('layouts.app')

@section('content')
    <div class="container">
        <!--All users button + back-->
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
                            <div class="col-md-6 card-body">
                                <div id="map">
                                    <?php
                                    include_once(app_path('Http/UrlSigner.php'));

                                    $apikey = env('GOOGLE_API_KEY');
                                    $signature = env('GOOGLE_SIGNATURE');

                                    $address = urlencode("{$location->address->street_number} {$location->address->street_name}, {$location->address->city}, {$location->address->country}");

                                    $mapURL = "https://maps.googleapis.com/maps/api/staticmap?center={$address}&markers={$address}&zoom=15&size=400x400&key={$apikey}";

                                    $signedMapURL = signUrl($mapURL, $signature);
                                    ?>
                                        <!-- Use PHP echo to insert PHP variables into HTML -->
                                    <img src="<?php echo $signedMapURL; ?>" alt="Map">

                                </div>
                                <div class="mb-2">
                                    <h5 class="text-secondary">{{__('location.public_show_address')}}</h5>
                                    {{$location->address->street_name}} {{$location->address->street_number}},
                                    {{$location->address->zip_code}} {{$location->address->city}}
                                </div>
                                <h5 class="text-secondary">{{__('location.public_show_long_description')}}</h5>
                                {!!$location->long_description!!}
                            </div>
                            <div class="col-md-4">
                                <div class="row row-cols-auto">
                                    <div>
                                        @if(isset($location) && $location->cover_img_path)
                                            <img
                                                src="{{ old('cover_img_path') ? asset(old('cover_img_path')) : asset($location->cover_img_path) }}"
                                                alt="{{__('customLabels.instructor_profile_img')}}"
                                                style="max-width: 100px;"
                                                class="img-thumbnail card-img justify-content-md-center"><br>
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
