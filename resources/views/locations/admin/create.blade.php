@extends('layouts.admin')

@section('head')
    @include('partials._tinymceSetup')
@endsection

@section('admin_content')
    @include('partials._systemFeedback')

    <div class="container">
        <!--All locations button + back-->
        <div class="d-grid d-md-flex gap-2"><br>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="{{route('admin.locations.index')}}">{{__('location.public_show_all_locations')}}</a>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="javascript:history.back()">{{__('customLabels.back')}}</a>
        </div>

        <div class="row justify-content-md-center">
            <div class="card">
                <div class="card-header">
                    {{__('location.location')}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.locations.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        @include('partials._locationInfoInput')
                        <button type="submit"
                                class="btn btn-success mb-2 mt-2 px-3">{{__('customLabels.create')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
