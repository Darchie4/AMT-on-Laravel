@extends('layouts.app')

@section('head')
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
    <script src="{{ asset('js/admin/lesson/updateMinMaxValues.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        @if($errors->any())
            <b class="textRed">Der er fejl!</b>
            <ul>
                @foreach($errors->keys() as $key)
                    <li>{{$key}}: {{implode(', ', $errors->get($key))}}</li>
                @endforeach

            </ul>
        @endif

        <form class="row g-3" action="{{route("admin.lesson.doCreate")}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="col form-group">
                <label for="name">{{__('customlabels.lesson_create_Name')}}</label> <br>
                <input class="form-control" id="name" name="name" type="text" required> <br>

                <label for="short_description">{{__('customlabels.lesson_create_ShortDescription')}}</label><br>
                <input class="form-control" id="short_description" name="short_description" type="text" required> <br>

                <label for="danceStyle">{{__('customlabels.lesson_create_danceStyle')}}</label><br>
                <input class="form-control" name="danceStyle" list="danceStyles"
                       placeholder="{{__('customlabels.lesson_create_dance_style_placeholder')}}" required><br>
                <datalist id="danceStyles">
                    @foreach($danceStyles as $style)
                        <option value="{{$style->name}}">{{$style->name}}</option>
                    @endforeach
                </datalist>

                <label for="difficulty">{{__('customlabels.lesson_create_difficulty')}}</label><br>
                <input class="form-control" name="difficulty" id="difficulty" list="difficulties"
                       placeholder="{{__('customlabels.lesson_create_difficulty_placeholder')}}" required><br>
                <datalist id="difficulties">
                    @foreach($difficulties as $difficulty)
                        <option
                            data-id="{{$difficulty->id}}"
                            data-index="{{$difficulty->sorting_index}}">{{$difficulty->name}}</option>
                    @endforeach
                </datalist>
                <input class="form-control" type="hidden" id="sorting_index" name="sorting_index">

                <label for="instructors[]">{{__('customlabels.lesson_create_instructor')}}</label><br>
                <select id="choices-multiple-remove-button"
                        placeholder="{{__('customlabels.lesson_create_select_instructor_placeholder')}}" multiple
                        id="instructor"
                        name="instructors[]">
                    @foreach($instructors as $instructor)
                        <option value={{$instructor -> id}}>{{$instructor -> user -> name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="vr mx-3 p-0"></div>

            <div class="col form-group">
                <label for="age_min">{{__('customlabels.lesson_create_ageMin')}}</label><br>
                <input class="form-control" id="age_min" name="age_min" type="number" required><br>

                <label for="age_max">{{__('customlabels.lesson_create_ageMax')}}</label><br>
                <input class="form-control" id="age_max" name="age_max" type="number" required><br>

                <label for="price">{{__('customlabels.lesson_create_Price')}}</label><br>
                <input class="form-control" id="price" name="price" type="number" required><br>

                <div class="form-control">
                    <div id="timeslotsContainer">
                        <h3>Time and location</h3>
                        <div class="row g-2">
                            <div class="col">
                                <label for="start_time_0">Start Time</label>
                                <input class="form-control" type="time" id="start_time_0" name="start_times[]" required>
                            </div>
                            <div class="col">
                                <label for="end_time_0">End Time</label>
                                <input class="form-control" type="time" id="end_time_0" name="end_times[]" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <label for="day_0">Day of Week</label>
                                <select class="form-control" id="day_0" name="days[]" required>
                                    <option value="0">Monday</option>
                                    <option value="1">Tuesday</option>
                                    <option value="2">Wednesday</option>
                                    <option value="3">Thursday</option>
                                    <option value="4">Friday</option>
                                    <option value="5">Saturday</option>
                                    <option value="6">Sunday</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="location_0">Location</label>
                                <select class="form-control" id="location_0" name="locations[]" required>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto mt-3 text-center">
                        <button class="mx-auto btn btn-primary" type="button" onclick="addTimeslot()">
                            {{__('customlabels.lesson_create_button_add_timeslot')}}
                        </button>
                    </div>
                </div>
            </div>

            <div class="vr mx-3 p-0"></div>

            <div class="col form-group">
                <label for="season_start">{{__('customlabels.lesson_create_seasonStart')}}</label><br>
                <input class="form-control" id="season_start" name="season_start" type="date" required><br>

                <label for="season_end">{{__('customlabels.lesson_create_seasonEnd')}}</label><br>
                <input class="form-control" id="season_end" name="season_end" type="date" required><br>

                <label for="total_signup_space">{{__('customlabels.lesson_create_totalSignupSpaces')}}</label><br>
                <input class="form-control" id="total_signup_space" name="total_signup_space" type="number"
                       required><br>

                <label for="visible">{{__('customlabels.lesson_create_toggle_visible')}}</label>
                <input class="form-check-input" type="checkbox" id="visible" name="visible" checked><br><br>

                <label for="can_signup">{{__('customlabels.lesson_create_toggle_signup')}}</label>
                <input class="form-check-input" type="checkbox" id="can_signup" name="can_signup"><br><br>

                <label for="cover_image">{{__('customlabels.lesson_create_coverImage')}}</label><br>
                <input class="form-control" id="cover_image" name="cover_image" type="file"
                       accept="image/png, image/jpeg"><br>
            </div>

            <label for="long_description">{{__('customlabels.lesson_create_LongDescription')}}</label><br>
            <textarea id="long_description" name="long_description" required></textarea><br>

            <button class="btn btn-success" type="submit"
                    value="Submit">{{__('customlabels.lesson_create_button_submit')}}</button>
        </form>
    </div>
@endsection
