@extends('layouts.admin')

@section('admin_content')
    @include('partials._systemFeedback')

    <div class="container">
        <h2>{{__('pricing.admin_show_all_pricings')}}</h2>
        <div class="row row-cols-2">
            <!--Search box -->
            <div class="d-grid justify-content-md-start mb-2 col-md-9">
                <form action="{{route('admin.pricing.index')}}" method="GET">
                    <div class="input-group">
                        <input class="form-control"
                               type="search"
                               placeholder="{{__('pricing.pricing_search_here')}}"
                               name="search"
                               id="usertable-search-input"
                               value="{{request('search')}}"/>
                        <span class="input-group-text">
                            <button class="btn btn-sm p-1" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            <!--Create new btn-->
            <div class="d-grid justify-content-md-end col-md-2 mb-2"><br>
                <a class="btn btn-outline-primary mb-2" role="button"
                   href="{{route('admin.pricing.create')}}">{{__('pricing.create')}}</a>
            </div>
        </div>

        <!--Instructor table-->
        <div class="row justify-content-center">
            <div>
                <table class="table table-bordered border-primary">
                    <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('pricing.name')}}</th>
                        <th scope="col">{{__('pricing.price')}}</th>
                        <th scope="col">{{__('pricing.frequency')}}</th>
                        <th scope="col">{{__('pricing.administration')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pricingStructures as $pricing)
                        <tr>
                            <td>{{$pricing->id}}</td>
                            <td>
                                <p>{{$pricing->name}}</p>
                            </td>
                            <td>
                                <p>{{$pricing->price}}</p>
                            </td>
                            <td>
                                <p>{{$pricing->payment_frequency}}*{{$pricing->frequency_multiplier}}</p>
                            </td>
                            <td>
                                <a role="button" class="btn btn-outline-primary"
                                   href="{{route('admin.pricing.edit', $pricing->id)}}">{{__('pricing.edit')}}</a>
                                <form class="d-inline-flex" method="post"
                                      action="{{route('admin.pricing.destroy',$pricing->id)}}"
                                      onsubmit="return confirm('{{__('pricing.confirm')}}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{__('pricing.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
