@extends('layouts.admin')

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

@section('admin_content')
    <div class="container">
        @if($errors->any())
            <b class="textRed">Der er fejl!</b>
            <ul>
                @foreach($errors->keys() as $key)
                    <li>{{$key}}: {{implode(', ', $errors->get($key))}}</li>
                @endforeach

            </ul>
        @endif
            <div class="my-5 text-center">
                <h1>{{__('lesson.admin_create_title')}}</h1>
            </div>
            <div class="my-3 d-grid d-md-flex gap-2"><br>

                <a class="btn btn-outline-primary mb-2" role="button"
                   href="{{route('admin.lesson.index')}}">{{__('lesson.admin_create_button_showAll')}}</a>
                <a class="btn btn-outline-primary mb-2" role="button"
                   href="javascript:history.back()">{{__('customLabels.back')}}</a>
            </div>
        <hr class="hr">
        <form class="row g-3" action="{{route("admin.lesson.doCreate")}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="col form-group">
                <label for="name">{{__('lesson.admin_create_Name')}}</label> <br>
                <input class="form-control" id="name" name="name" type="text" required> <br>

                <label for="short_description">{{__('lesson.admin_create_shortDescription')}}</label><br>
                <input class="form-control" id="short_description" name="short_description" type="text" required> <br>

                <label for="danceStyle">{{__('lesson.admin_create_danceStyle')}}</label><br>
                <input class="form-control" name="danceStyle" list="danceStyles"
                       placeholder="{{__('lesson.admin_create_placeholder_danceStyle')}}" required><br>
                <datalist id="danceStyles">
                    @foreach($danceStyles as $style)
                        <option value="{{$style->name}}">{{$style->name}}</option>
                    @endforeach
                </datalist>

                <label for="difficulty">{{__('lesson.admin_create_difficulty')}}</label><br>
                <input class="form-control" name="difficulty" id="difficulty" list="difficulties"
                       placeholder="{{__('lesson.admin_create_placeholder_difficulty')}}" required><br>
                <datalist id="difficulties">
                    @foreach($difficulties as $difficulty)
                        <option
                            data-id="{{$difficulty->id}}"
                            data-index="{{$difficulty->sorting_index}}">{{$difficulty->name}}</option>
                    @endforeach
                </datalist>
                <input class="form-control" type="hidden" id="sorting_index" name="sorting_index">

                <label for="instructors[]">{{__('lesson.admin_create_instructor')}}</label> <a href="{{route('admin.instructors.create')}}">{{__('lesson.admin_create_link_instructor')}}</a><br>
                <select id="choices-multiple-remove-button"
                        placeholder="{{__('lesson.admin_create_placeholder_selectInstructor')}}" multiple
                        id="instructor"
                        name="instructors[]">
                    @foreach($instructors as $instructor)
                        <option value={{$instructor -> id}}>{{$instructor->user->name.' '.$instructor->user->fname}}</option>
                    @endforeach
                </select>
            </div>

            <div class="vr mx-3 p-0"></div>

            <div class="col form-group">
                <label for="age_min">{{__('lesson.admin_create_ageMin')}}</label><br>
                <input class="form-control" id="age_min" name="age_min" type="number" required><br>

                <label for="age_max">{{__('lesson.admin_create_ageMax')}}</label><br>
                <input class="form-control" id="age_max" name="age_max" type="number" required><br>

                <label for="price">{{__('lesson.admin_create_price')}}</label> <a href="#">{{__('lesson.admin_create_link_priceStructure')}}</a><br>
                <input class="form-control" id="price" name="price" type="number" required><br>

                <div class="form-control">
                    <div id="timeslotsContainer">
                        <h3>{{__('lesson.admin_create_title_timeAndLocation')}}</h3>
                        <a href="{{route('admin.locations.create')}}">{{__('lesson.admin_create_link_location')}}</a><br>

                        <div class="row g-2">
                            <div class="col">
                                <label for="start_time_0">{{__('lesson.admin_create_startTime')}}</label>
                                <input class="form-control" type="time" id="start_time_0" name="start_times[]" required>
                            </div>
                            <div class="col">
                                <label for="end_time_0">{{__('lesson.admin_create_endTime')}}</label>
                                <input class="form-control" type="time" id="end_time_0" name="end_times[]" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <label for="day_0">{{__('lesson.admin_create_weekDay_title')}}</label>
                                <select class="form-control" id="day_0" name="days[]" required>
                                    <option value="0">{{__('lesson.admin_create_weekDay_monday')}}</option>
                                    <option value="1">{{__('lesson.admin_create_weekDay_tuesday')}}</option>
                                    <option value="2">{{__('lesson.admin_create_weekDay_wednesday')}}</option>
                                    <option value="3">{{__('lesson.admin_create_weekDay_thursday')}}</option>
                                    <option value="4">{{__('lesson.admin_create_weekDay_friday')}}</option>
                                    <option value="5">{{__('lesson.admin_create_weekDay_saturday')}}</option>
                                    <option value="6">{{__('lesson.admin_create_weekDay_sunday')}}</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="location_0">{{__('lesson.admin_create_location')}}</label>
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
                            {{__('lesson.lesson_create_button_add_timeslot')}}
                        </button>
                    </div>
                </div>
            </div>

            <div class="vr mx-3 p-0"></div>

            <div class="col form-group">
                <label for="season_start">{{__('lesson.admin_create_seasonStart')}}</label><br>
                <input class="form-control" id="season_start" name="season_start" type="date" required><br>

                <label for="season_end">{{__('lesson.admin_create_seasonEnd')}}</label><br>
                <input class="form-control" id="season_end" name="season_end" type="date" required><br>

                <label for="total_signup_space">{{__('lesson.admin_create_totalSignupSpaces')}}</label><br>
                <input class="form-control" id="total_signup_space" name="total_signup_space" type="number"
                       required><br>

                <label for="visible">{{__('lesson.admin_create_toggle_visible')}}</label>
                <input class="form-check-input" type="checkbox" id="visible" name="visible" checked><br><br>

                <label for="can_signup">{{__('lesson.admin_create_toggle_signup')}}</label>
                <input class="form-check-input" type="checkbox" id="can_signup" name="can_signup"><br><br>

                <label for="cover_image">{{__('lesson.admin_create_coverImage')}}</label><br>
                <input class="form-control" id="cover_image" name="cover_image" type="file"
                       accept="image/png, image/jpeg"><br>
            </div>

            <label for="long_description">{{__('lesson.admin_create_LongDescription')}}</label><br>
            <textarea id="long_description" name="long_description" required></textarea><br>

            <button class="btn btn-success" type="submit"
                    value="Submit">{{__('lesson.admin_create_button_submit')}}</button>
        </form>
    </div>
@endsection
