@extends('layouts.app')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">

    <script src="{{ asset('js/admin/lesson/updateMinMaxValues.js') }}"></script>

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

        tinymce.init({
            selector: 'textarea#long_description'
        });
    </script>
    <script src="{{ asset('js/admin/lesson/timeSlotSelector.js') }}" data-locations="{{ json_encode($locations) }}"></script>
</head>

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
                       placeholder="Ex. Pardans, Hip Hop osv..." required><br>
                <datalist id="danceStyles">
                    @foreach($danceStyles as $style)
                        <option value="{{$style->name}}">{{$style->name}}</option>
                    @endforeach
                </datalist>

                <label for="difficulty">{{__('customlabels.lesson_create_difficulty')}}</label><br>
                <input class="form-control" name="difficulty" list="skillLeveles"
                       placeholder="Ex. Begynder, Let Øvet osv..." required><br>
                <datalist id="difficulties">
                    @foreach($difficulties as $difficulty)
                        <option value="{{$difficulty->id}}">{{$difficulty->name}}</option>
                    @endforeach
                </datalist>

                <label for="instructors[]">{{__('customlabels.lesson_create_instructor')}}</label><br>
                <select id="choices-multiple-remove-button" placeholder="Vælg undervisere" multiple id="instructor"
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

                <div id="timeslotsContainer">
                    <!-- Timeslot inputs will be dynamically added here -->
                </div>
                <button type="button" onclick="addTimeslot()">Add Timeslot</button>
            </div>

            <div class="vr mx-3 p-0"></div>

            <div class="col form-group">
                <label for="season_start">{{__('customlabels.lesson_create_seasonStart')}}</label><br>
                <input class="form-control" id="season_start" name="season_start" type="date" required><br>

                <label for="season_end">{{__('customlabels.lesson_create_seasonEnd')}}</label><br>
                <input class="form-control" id="season_end" name="season_end" type="date" required><br>

                <label for="cover_image">{{__('customlabels.lesson_create_coverImage')}}</label><br>
                <input class="form-control-file" id="cover_image" name="cover_image" type="file" accept="image/png, image/jpeg"><br>
            </div>

            <label for="long_description">{{__('customlabels.lesson_create_LongDescription')}}</label><br>
            <textarea id="long_description" name="long_description" required></textarea><br>

            <button type="submit" value="Submit">Submit</button>
        </form>
    </div>

@endsection
