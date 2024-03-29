@php use Carbon\Carbon; @endphp
@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
        <h1 class="text-center">{{$lesson -> name}}</h1>

        <div class="col col-lg-7 vh-50">

            <div>
                <h2>Praktisk information</h2>
                <b>Stilart:</b> {{$lesson->danceStyle->name}}<br>
                <b>Dygtigheds grad:</b> {{$lesson->difficulty->name}}<br>
                <b>Alders gruppe:</b> {{$lesson->age_min}} - {{$lesson->age_max}} år<br>
                <b>Pris:</b> {{$lesson->price}} DKK.<br>
                <b>Sæson start:</b> {{Carbon::parse($lesson->season_start)->format("d-m-Y")}}<br>
                <b>Sæson slut:</b> {{Carbon::parse($lesson->season_end)->format("d-m-Y")}}<br>
            </div>
            
            <div>
                <h2 class="pt-3">Trænings tider</h2>
                @foreach($lesson->lessonTimeLocations as $lessonTimeLocation)
                    @if($loop -> first || $loop->index % 3 == 0)
                        <div class="row p-0">
                            @endif
                            <div class="col ">
                                <b>Location: </b> {{$lessonTimeLocation ->location->name}} <br>
                                <b>Week day: </b> {{trans(Carbon::getDays()[$lessonTimeLocation->week_day])}}<br>
                                <b>Time Start: </b> {{$lessonTimeLocation -> start_time}} <br>
                                <b>Time End: </b> {{$lessonTimeLocation ->end_time}} <br>
                            </div>
                            @if(!$loop -> last && ($loop->index+1) % 3 != 0)
                                <hr class="vr p-0">
                            @elseif($loop -> last || $loop->index % 3 == 0)
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="col col-lg-5 vh-50">
            <div class="shadow-lg p-3 mb-5 bg-body rounded container">
                @foreach($lesson->instructors as $instructor)
                    @if($loop->index % 2 == 0)
                        <div class="row">
                    @endif
                    <div class="col text-center p-0 mx-0">
                        <img src="{{asset($instructor->profile_img_path)}}"
                             class="w-50 img-fluid mx-auto d-block img-thumbnail rounded-circle"
                             alt="Billede af: {{$instructor->user->name}}">
                        {{$instructor->user->name}}
                    </div>
                    @if($loop->index % 2 != 0 && !$loop->last)
                        </div>
                        <hr class="p-0">
                    @elseif($loop->index % 2 != 0 || $loop->last)
                        </div>
                    @else
                        <hr class="vr p-0">
                    @endif
                @endforeach
            </div>
        </div>
        <h2 class="pt-3">Beskrivelse</h2>
        {!! $lesson->logn_description !!}
    </div>

@endsection
