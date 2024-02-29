@extends('layouts.app')

@section('content')

<form action="{{route("admin.lesson.doCreate")}}" method="post" enctype="multipart/form-data">
    <label for="name">{{__('customlabels.Fuckoff')}}</label> <br>
    <input id="name" type="text"><br>

    <label for="short_description">{{__('customlabels.Fuckoff')}}</label><br>
    <input id="short_description" type="text"><br>

    <label for="long_description">{{__('customlabels.Fuckoff')}}</label><br>
    <textarea id="long_description"></textarea><br>



    <button type="submit" value="Submit">Submit</button>
</form>

@endsection
