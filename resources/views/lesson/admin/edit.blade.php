@php use Carbon\Carbon; @endphp
@extends('layouts.app')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script>
        $(document).ready(function () {
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount: 5,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            });
        });
    </script>
    <script src="{{ asset('js/admin/lesson/timeSlotSelector.js') }}"
            data-locations="{{ json_encode($locations) }}"></script>
    <script src="{{ asset('js/admin/lesson/difficultySortingChangeSelector.js') }}"></script>
    <script src="{{ asset('js/admin/lesson/inputValidation.js') }}"></script>
</head>

@section('content')
    <div class="container">

        <form class="row g-3" action="{{route((Auth::user()->can('admin_panel') ? 'admin.lesson.doEdit' : 'instructor.lesson.doEdit') , ['id'=>$lesson->id])}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col form-group">
                <label for="name">{{__('customlabels.lesson_create_Name')}}</label> <br>
                <input class="form-control" id="name" name="name" type="text" value="{{$lesson->name}}" required> <br>

                <label for="short_description">{{__('customlabels.lesson_create_ShortDescription')}}</label><br>
                <input class="form-control" id="short_description" name="short_description"
                       value="{{$lesson->short_description}}" type="text" required> <br>

                <label for="danceStyle">{{__('customlabels.lesson_create_danceStyle')}}</label><br>
                <input class="form-control" name="danceStyle" list="danceStyles"
                       placeholder="Ex. Pardans, Hip Hop osv..." value="{{ $lesson->danceStyle->name }}" required><br>
                <datalist id="danceStyles">
                    @foreach($danceStyles as $style)
                        <option
                            value="{{$style->name}}" {{ $style->id == $lesson->danceStyle->id ? 'selected' : '' }}>{{$style->name}}</option>
                    @endforeach
                </datalist>

                <label for="difficulty">{{__('customlabels.lesson_create_difficulty')}}</label><br>
                <input class="form-control" name="difficulty" id="difficulty" list="difficulties"
                        placeholder="Ex. Begynder, Let Øvet osv..." value="{{ $lesson->difficulty->name }}" required><br>
                <datalist id="difficulties">
                    @foreach($difficulties as $difficulty)
                        <option
                            {{ $difficulty->id == $lesson->difficulty->id ? 'selected' : '' }} value="{{$difficulty->name}}"
                            data-id="{{$difficulty->id}}"
                            data-index="{{$difficulty->sorting_index}}">{{$difficulty->name}}</option>
                    @endforeach
                </datalist>
                <input class="form-control" type="hidden" id="sorting_index" name="sorting_index">

                <label for="instructors">{{__('customlabels.lesson_create_instructor')}}</label><br>
                <select id="choices-multiple-remove-button" placeholder="Vælg undervisere" multiple
                        {{ Auth::user()->can('admin_panel') ? '' : 'disabled' }} name="instructors[]">
                    @foreach($instructors as $instructor)
                        <option
                            value="{{ $instructor->id }}" {{ in_array($instructor->id, $lesson->instructors->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $instructor->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="vr mx-3 p-0"></div>

            <div class="col form-group">
                <label for="age_min">{{__('customlabels.lesson_create_ageMin')}}</label><br>
                <input class="form-control" id="age_min" name="age_min" type="number" value="{{ $lesson-> age_min}}"
                       required><br>

                <label for="age_max">{{__('customlabels.lesson_create_ageMax')}}</label><br>
                <input class="form-control" id="age_max" name="age_max" value="{{ $lesson-> age_max}}" type="number"
                       required><br>

                <label for="price">{{__('customlabels.lesson_create_Price')}}</label><br>
                <input class="form-control" id="price" name="price" type="number" value="{{ $lesson-> price}}" {{ Auth::user()->can('admin_panel') ? '' : 'disabled' }}  required><br>

                <div class="form-control">
                    <div id="timeslotsContainer">
                        @foreach($lesson->lessonTimeLocations as $timeslot)
                            @if(!$loop->first)
                                <hr>
                            @endif
                            <h3>Time and location</h3>
                            <div class="row g-2">
                                <div class="col">
                                    <label for="start_time_{{$loop->index}}">Start Time</label> <br>
                                    <input class="form-control" type="time" id="start_time_{{$loop->index}}"
                                           name="start_times[]"
                                           value="{{$timeslot->start_time }}"
                                           {{ Auth::user()->can('admin_panel') ? 'required' : 'disabled' }} required>
                                </div>
                                <div class="col">
                                    <label for="end_time_{{$loop->index}}">End Time</label> <br>
                                    <input class="form-control" type="time" id="end_time_{{$loop->index}}"
                                           name="end_times[]"
                                           value="{{ $timeslot->end_time }}"
                                           {{ Auth::user()->can('admin_panel') ? 'required' : 'disabled' }} required>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col">
                                    <label for="day_{{$loop->index}}">Day of Week</label> <br>
                                    <select class="form-control" id="day_{{$loop->index}}" name="days[]"
                                            {{ Auth::user()->can('admin_panel') ? 'required' : 'disabled' }} required>
                                        <option value="0" {{ $timeslot->day == 0 ? 'selected' : '' }}>Monday</option>
                                        <option value="1" {{ $timeslot->day == 1 ? 'selected' : '' }}>Tuesday</option>
                                        <option value="2" {{ $timeslot->day == 2 ? 'selected' : '' }}>Wednesday</option>
                                        <option value="3" {{ $timeslot->day == 3 ? 'selected' : '' }}>Thursday</option>
                                        <option value="4" {{ $timeslot->day == 4 ? 'selected' : '' }}>Friday</option>
                                        <option value="5" {{ $timeslot->day == 5 ? 'selected' : '' }}>Saturday</option>
                                        <option value="6" {{ $timeslot->day == 6 ? 'selected' : '' }}>Sunday</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="location_{{$loop->index}}">Location</label> <br>
                                    <select class="form-control" id="location_{{$loop->index}}" name="locations[]"
                                            {{ Auth::user()->can('admin_panel') ? 'required' : 'disabled' }} >
                                        @foreach($locations as $location)
                                            <option
                                                value="{{ $location->id }}" {{ $timeslot->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mx-auto mt-3 text-center">
                        <button class="mx-auto btn btn-primary" type="button" onclick="addTimeslot()" {{ Auth::user()->can('admin_panel') ? '' : 'disabled' }} >Add Timeslot
                        </button>
                    </div>
                </div>
            </div>

            <div class="vr mx-3 p-0"></div>

            <div class="col form-group">
                <label for="season_start">{{__('customlabels.lesson_create_seasonStart')}}</label><br>
                <input class="form-control" id="season_start" name="season_start" type="date"
                       value="{{Carbon::parse($lesson->season_start)->format("Y-m-d")}}"
                       {{ Auth::user()->can('admin_panel') ? 'required' : 'disabled' }} ><br>

                <label for="season_end">{{__('customlabels.lesson_create_seasonEnd')}}</label><br>
                <input class="form-control" id="season_end" name="season_end" type="date"
                       value="{{Carbon::parse($lesson->season_end)->format("Y-m-d")}}"
                       {{ Auth::user()->can('admin_panel') ? 'required' : 'disabled' }} ><br>

                <label for="cover_image">{{__('customlabels.lesson_create_coverImage')}}</label><br>
                @if($lesson->cover_img_path)
                    <img src="{{ asset($lesson->cover_img_path) }}" alt="Lesson Cover Image"
                         style="max-width: 200px;">
                @endif
                <br>
                <input class="form-control" id="cover_image" name="cover_image" type="file"
                       accept="image/png, image/jpeg">
            </div>

            <label for="long_description">{{__('customlabels.lesson_create_LongDescription')}}</label><br>
            <textarea id="long_description" name="long_description"
                      required>{{ $lesson->long_description }}</textarea><br>
            <button class="btn btn-success" type="submit" value="Submit">Submit</button>

        </form>
    </div>
@endsection
