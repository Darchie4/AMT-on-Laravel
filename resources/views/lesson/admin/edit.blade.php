@php use Carbon\Carbon; @endphp
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

@endsection

@section('content')
    <div class="container">

        <form class="row g-3" action="{{route((Auth::user()->can('lessons_crud
') ? 'admin.lesson.doEdit' : 'instructor.lesson.doEdit') , ['id'=>$lesson->id])}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col form-group">
                <label for="name">{{__('lesson.admin_create_Name')}}</label> <br>
                <input class="form-control" id="name" name="name" type="text" value="{{$lesson->name}}" required> <br>

                <label for="short_description">{{__('lesson.admin_create_danceStyle')}}</label><br>
                <input class="form-control" id="short_description" name="short_description"
                       value="{{$lesson->short_description}}" type="text" required> <br>

                <label for="danceStyle">{{__('lesson.admin_create_danceStyle')}}</label><br>
                <input class="form-control" name="danceStyle" list="danceStyles"
                       placeholder="{{__('lesson.admin_create_placeholder_danceStyle')}}"
                       value="{{ $lesson->danceStyle->name }}" required><br>
                <datalist id="danceStyles">
                    @foreach($danceStyles as $style)
                        <option
                                value="{{$style->name}}" {{ $style->id == $lesson->danceStyle->id ? 'selected' : '' }}>{{$style->name}}</option>
                    @endforeach
                </datalist>

                <label for="difficulty">{{__('lesson.admin_create_difficulty')}}</label><br>
                <input class="form-control" name="difficulty" id="difficulty" list="difficulties"
                       placeholder="{{__('lesson.admin_create_placeholder_difficulty')}}"
                       value="{{ $lesson->difficulty->name }}" required><br>
                <datalist id="difficulties">
                    @foreach($difficulties as $difficulty)
                        <option
                                {{ $difficulty->id == $lesson->difficulty->id ? 'selected' : '' }} value="{{$difficulty->name}}"
                                data-id="{{$difficulty->id}}"
                                data-index="{{$difficulty->sorting_index}}">{{$difficulty->name}}</option>
                    @endforeach
                </datalist>
                <input class="form-control" type="hidden" id="sorting_index" name="sorting_index">

                <label for="instructors">{{__('lesson.admin_create_instructor')}}</label><br>
                <select id="choices-multiple-remove-button"
                        placeholder="{{__('lesson.admin_create_placeholder_selectInstructor')}}" multiple
                        {{ Auth::user()->can('lessons_crud
') ? '' : 'disabled' }} name="instructors[]">
                    @foreach($instructors as $instructor)
                        <option
                                value="{{ $instructor->id }}" {{ in_array($instructor->id, $lesson->instructors->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $instructor->user->name.' '.$instructor->user->fname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="vr mx-3 p-0"></div>

            <div class="col form-group">
                <label for="age_min">{{__('lesson.admin_create_ageMin')}}</label><br>
                <input class="form-control" id="age_min" name="age_min" type="number" value="{{ $lesson-> age_min}}"
                       required><br>

                <label for="age_max">{{__('lesson.admin_create_ageMax')}}</label><br>
                <input class="form-control" id="age_max" name="age_max" value="{{ $lesson-> age_max}}" type="number"
                       required><br>

                <label for="pricing_structure">{{__('lesson.admin_create_price')}}</label><br>
                <select class="form-control form-select" id="pricing_structure" name="pricing_structure"
                       {{ Auth::user()->can('lessons_crud') ? '' : 'disabled' }}  required>
                    @php
                        $selectedPricing = old('pricing_structure_id', $lesson->pricing_structure_id ?? null);
                    @endphp
                    <option disabled {{is_null($selectedPricing)? 'selected':''}}>{{ __('pricing.choose')}}</option>
                    @foreach($pricings as $pricingOption)
                        <option
                            value="{{$pricingOption->id}}" {{ $selectedPricing == $pricingOption->id ? 'selected' : '' }}>{{$pricingOption->name .' ('. $pricingOption->price.' '.'kr. - '}} {{__('pricing.' . $pricingOption->payment_frequency) . ')'}}</option>
                    @endforeach
                </select>
                    <br>

                <div class="form-control">
                    <div id="timeslotsContainer">
                        @foreach($lesson->lessonTimeLocations as $timeslot)
                            @if(!$loop->first)
                                <hr>
                            @endif
                            <h3>{{__('lesson.admin_create_title_timeAndLocation')}}</h3>
                            <div class="row g-2">
                                <div class="col">
                                    <label for="start_time_{{$loop->index}}">{{__('lesson.admin_create_startTime')}}</label>
                                    <br>
                                    <input class="form-control" type="time" id="start_time_{{$loop->index}}"
                                           name="start_times[]"
                                           value="{{$timeslot->start_time }}"
                                           {{ Auth::user()->can('lessons_crud
') ? 'required' : 'disabled' }} required>
                                </div>
                                <div class="col">
                                    <label for="end_time_{{$loop->index}}">{{__('lesson.admin_create_endTime')}}</label>
                                    <br>
                                    <input class="form-control" type="time" id="end_time_{{$loop->index}}"
                                           name="end_times[]"
                                           value="{{ $timeslot->end_time }}"
                                           {{ Auth::user()->can('lessons_crud
') ? 'required' : 'disabled' }} required>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col">
                                    <label for="day_{{$loop->index}}">{{__('lesson.admin_create_weekDay_title')}}</label>
                                    <br>
                                    <select class="form-control" id="day_{{$loop->index}}" name="days[]"
                                            {{ Auth::user()->can('lessons_crud
') ? 'required' : 'disabled' }} required>
                                        <option value="0" {{ $timeslot->day == 0 ? 'selected' : '' }}>{{__('lesson.admin_create_weekDay_monday')}}</option>
                                        <option value="1" {{ $timeslot->day == 1 ? 'selected' : '' }}>{{__('lesson.admin_create_weekDay_tuesday')}}</option>
                                        <option value="2" {{ $timeslot->day == 2 ? 'selected' : '' }}>{{__('lesson.admin_create_weekDay_wednesday')}}</option>
                                        <option value="3" {{ $timeslot->day == 3 ? 'selected' : '' }}>{{__('lesson.admin_create_weekDay_thursday')}}</option>
                                        <option value="4" {{ $timeslot->day == 4 ? 'selected' : '' }}>{{__('lesson.admin_create_weekDay_friday')}}</option>
                                        <option value="5" {{ $timeslot->day == 5 ? 'selected' : '' }}>{{__('lesson.admin_create_weekDay_saturday')}}</option>
                                        <option value="6" {{ $timeslot->day == 6 ? 'selected' : '' }}>{{__('lesson.admin_create_weekDay_sunday')}}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="location_{{$loop->index}}">{{__('lesson.admin_create_location')}}</label>
                                    <br>
                                    <select class="form-control" id="location_{{$loop->index}}" name="locations[]"
                                            {{ Auth::user()->can('lessons_crud
') ? 'required' : 'disabled' }} >
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
                        <button class="mx-auto btn btn-primary" type="button" onclick="addTimeslot()" {{ Auth::user()->can('lessons_crud
') ? '' : 'disabled' }} >{{__('lesson.admin_create_button_addTimeslot')}}
                        </button>
                    </div>
                </div>
            </div>

            <div class="vr mx-3 p-0"></div>

            <div class="col form-group">
                <label for="season_start">{{__('lesson.admin_create_seasonStart')}}</label><br>
                <input class="form-control" id="season_start" name="season_start" type="date"
                       value="{{Carbon::parse($lesson->season_start)->format("Y-m-d")}}"
                        {{ Auth::user()->can('lessons_crud
 ') ? 'required' : 'disabled' }} ><br>

                <label for="season_end">{{__('lesson.admin_create_seasonEnd')}}</label><br>
                <input class="form-control" id="season_end" name="season_end" type="date"
                       value="{{Carbon::parse($lesson->season_end)->format("Y-m-d")}}"
                        {{ Auth::user()->can('lessons_crud
 ') ? 'required' : 'disabled' }} ><br>

                <label for="total_signup_space">{{__('lesson.admin_create_totalSignupSpaces')}}</label><br>
                <input class="form-control" id="total_signup_space" name="total_signup_space" type="number"
                       value="{{ $lesson->total_signup_space }}"
                        {{ Auth::user()->can('lessons_crud
    ') ? 'required' : 'disabled' }}><br>

                <label for="visible">{{__('lesson.admin_create_toggle_visible')}}</label>
                <input class="form-check-input" type="checkbox" id="visible" name="visible"
                        {{ Auth::user()->can('lessons_crud
    ') ? '' : 'disabled' }} {{ $lesson->visible ? 'checked' : '' }}><br>

                <label for="can_signup">{{__('lesson.admin_create_toggle_signup')}}</label>
                <input class="form-check-input" type="checkbox" id="can_signup" name="can_signup"
                        {{ Auth::user()->can('lessons_crud
    ') ? '' : 'disabled' }} {{ $lesson->can_signup ? 'checked' : '' }}><br>

                <label for="cover_image">{{__('lesson.admin_create_coverImage')}}</label><br>
                @if($lesson->cover_img_path)
                    <img src="{{ asset($lesson->cover_img_path) }}" alt="Lesson Cover Image"
                         style="max-width: 200px;">
                @endif
                <br>
                <input class="form-control" id="cover_image" name="cover_image" type="file"
                       accept="image/png, image/jpeg">
            </div>

            <label for="long_description">{{__('lesson.admin_create_LongDescription')}}</label><br>
            <textarea id="long_description" name="long_description"
                      required>{{ $lesson->long_description }}</textarea><br>
            <button class="btn btn-success" type="submit" value="Submit">{{__('lesson.admin_create_button_submit')}}</button>

        </form>
    </div>
@endsection
