@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <!--All locations button + back-->
        <div class="d-grid d-md-flex gap-2"><br>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="{{route('admin.pricing.index')}}">{{__('pricing.admin_show_all_pricings')}}</a>
            <a class="btn btn-outline-primary mb-2" role="button"
               href="javascript:history.back()">{{__('customLabels.back')}}</a>
        </div>

        <div class="row justify-content-md-center">
            <div class="card">
                <div class="card-header">
                    {{__('pricing.price_structure')}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.pricing.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        @include('partials._pricingStructureInput')
                        <button type="submit"
                                class="btn btn-success mb-2 mt-2 px-3">{{__('pricing.create')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
