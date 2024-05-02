@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">

    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @include('partials._tinymceSetup')
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
    @include('partials._systemFeedback')
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
                <label for="name"><b>{{__('lesson.admin_create_Name')}}</b></label> <br>
                <input class="form-control" id="name" name="name" type="text" required> <br>

                <label for="short_description"><b>{{__('lesson.admin_create_shortDescription')}}</b></label><br>
                <input class="form-control" id="short_description" name="short_description" type="text" maxlength="65" required> <br>

                <label for="danceStyle"><b>{{__('lesson.admin_create_danceStyle')}}</b></label><br>
                <input class="form-control" name="danceStyle" list="danceStyles"
                       placeholder="{{__('lesson.admin_create_placeholder_danceStyle')}}" required><br>
                <datalist id="danceStyles">
                    @foreach($danceStyles as $style)
                        <option value="{{$style->name}}">{{$style->name}}</option>
                    @endforeach
                </datalist>

                <label for="difficulty"><b>{{__('lesson.admin_create_difficulty')}}</b></label><br>
                <input class="form-control" name="difficulty" id="difficulty" list="difficulties"
                       placeholder="{{__('lesson.admin_create_placeholder_difficulty')}}" required>
                <datalist id="difficulties">
                    @foreach($difficulties as $difficulty)
                        <option
                            data-id="{{$difficulty->id}}"
                            data-index="{{$difficulty->sorting_index}}">{{$difficulty->name}}</option>
                    @endforeach
                </datalist>

                <label for="sorting_index" id="sorting_index_label" hidden="hidden"><b>{{__('lesson.admin_create_label_sortingIndex')}}</b></label>
                <div class="input-group" id="sorting_index_container" hidden>
                    <input class="form-control" type="number" id="sorting_index" name="sorting_index">
                    <span class="input-group-text">
                <i class="fas fa-question-circle" data-bs-toggle="tooltip" title="{{__('lesson.admin_create_explainer_sortingIndex')}}"></i>
            </span>
                </div><br>

                <label for="instructors[]"><b>{{__('lesson.admin_create_instructor')}}</b></label> <a href="{{route('admin.instructors.create')}}">{{__('lesson.admin_create_link_instructor')}}</a><br>
                <select id="choices-multiple-remove-button"
                        placeholder="{{__('lesson.admin_create_placeholder_selectInstructor')}}" multiple
                        id="instructor"
                        name="instructors[]">
                    @foreach($instructors as $instructor)
                        <option
                            value={{$instructor -> id}}>{{$instructor->user->name.' '.$instructor->user->lname}}</option>
                    @endforeach
                </select>
            </div>

            <div class="vr mx-3 p-0"></div>

            <div class="col form-group">
                <label for="age_min"><b>{{__('lesson.admin_create_ageMin')}}</b></label><br>
                <input class="form-control" id="age_min" name="age_min" type="number" required><br>

                <label for="age_max"><b>{{__('lesson.admin_create_ageMax')}}</b></label><br>
                <input class="form-control" id="age_max" name="age_max" type="number" required><br>


                <label for="pricing_structure"><b>{{__('lesson.admin_create_price')}}</b></label> <a href="{{route("admin.pricing.create")}}">{{__('lesson.admin_create_link_priceStructure')}}</a><br>
                <select class="form-control form-select" id="pricing_structure" name="pricing_structure" required>
                    <option disabled selected>{{ __('pricing.choose')}}</option>
                    @foreach($pricings as $pricing)
                        <option
                            value="{{$pricing->id}}">{{$pricing->name .' ('. $pricing->price.' '.__('pricing.currency').' - '}} {{__('pricing.' . $pricing->payment_frequency) . ')'}}</option>
                    @endforeach
                </select><br>


                <div class="form-control">
                    <div id="timeslotsContainer">
                        <h3>{{__('lesson.admin_create_title_timeAndLocation')}}</h3>

                        <div class="row g-2">
                            <div class="col">
                                <label for="start_time_0"><b>{{__('lesson.admin_create_startTime')}}</b></label>
                                <input class="form-control" type="time" id="start_time_0" name="start_times[]" required>
                            </div>
                            <div class="col">
                                <label for="end_time_0"><b>{{__('lesson.admin_create_endTime')}}</b></label>
                                <input class="form-control" type="time" id="end_time_0" name="end_times[]" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <label for="day_0"><b>{{__('lesson.admin_create_weekDay_title')}}</b></label>
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
                                <label for="location_0"><b>{{__('lesson.admin_create_location')}}</b> <a href="{{route('admin.locations.create')}}">{{__('lesson.admin_create_link_location')}}</a></label>
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
                            {{__('lesson.admin_create_button_add_timeslot')}}
                        </button>
                    </div>
                </div>
            </div>

            <div class="vr mx-3 p-0"></div>

            <div class="col form-group">
                <label for="season_start"><b>{{__('lesson.admin_create_seasonStart')}}</b></label><br>
                <input class="form-control" id="season_start" name="season_start" type="date" required><br>

                <label for="season_end"><b>{{__('lesson.admin_create_seasonEnd')}}</b></label><br>
                <input class="form-control" id="season_end" name="season_end" type="date" required><br>

                <label for="total_signup_space"><b>{{__('lesson.admin_create_totalSignupSpaces')}}</b></label><br>
                <input class="form-control" id="total_signup_space" name="total_signup_space" type="number"
                       required><br>

                <label for="visible"><b>{{__('lesson.admin_create_toggle_visible')}}</b></label>
                <input class="form-check-input" type="checkbox" id="visible" name="visible" checked><br><br>

                <label for="can_signup"><b>{{__('lesson.admin_create_toggle_signup')}}</b></label>
                <input class="form-check-input" type="checkbox" id="can_signup" name="can_signup"><br><br>

                <label for="cover_image"><b>{{__('lesson.admin_create_coverImage')}}</b></label><br>
                <input class="form-control" id="cover_image" name="cover_image" type="file"
                       accept="image/png, image/jpeg"><br>
            </div>

            <label for="long_description"><b>{{__('lesson.admin_create_LongDescription')}}</b></label><br>
            <textarea id="tinymce" name="long_description" required></textarea><br>

            <button class="btn btn-success" type="submit"
                    value="Submit">{{__('lesson.admin_create_button_submit')}}</button>
        </form>
    </div>
@endsection
