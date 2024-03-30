<!--Location name + cover img-->
<div class="row my-3">
    <!--Name-->
    <div class="col-6">
        <label for="name" class="form-label">{{ __('location.name') }}</label>
        <input class="form-control" type="text" name="name" value="{{old('name', $location->name ?? '')}}"
               required autocomplete="name" autofocus @error('name') is-invalid @enderror>
        @error('name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
    <!--Cover image-->
    <div class="col-6">
        <label class="form-label"
            for="cover_img_path">{{__('location.create_cover_image')}}</label>
        <br>

        <input class="form-control" id="cover_img_path" name="cover_img_path"
               type="file"
               accept="image/png, image/jpeg"><br>
        @if(isset($location) && $location->cover_img_path)
            <img
                src="{{ asset($location->cover_img_path) }}"
                alt="{{__('location.create_cover_image')}}" style="max-width: 200px;" class="img-fluid"><br>
        @endif
    </div>
</div>

<!--Short description-->
<div class="mt-2">
    <label for="short_description" class="form-label">{{ __('location.create_short_description') }}</label>
    <input class="form-control" type="text" name="short_description"
           value="{{old('short_description', $location->short_description ?? '')}}"
           required autocomplete="short_description" @error('short_description') is-invalid @enderror>
    @error('short_description')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<!--Long description-->
<div class="mt-2">
    <label for="long_description"
           class="form-label">{{ __('location.create_long_description') }}</label>
    <textarea class="form-control" name="long_description" rows="4" required
              autocomplete="long_description">@if(old('long_description', isset($location) ? $location->long_description : null))
            {{old('long_description', $location->long_description ?? '')}}
        @endif</textarea>
    <br>
    @error('long_description')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror

</div>

<br>
<h5 class="text-secondary">{{__('address.address')}}</h5>
<hr>

<!--Street number and name-->
<div class="row my-3">
    <div class="col-2">
        <label for="street_number" class="form-label">{{ __('address.street_number') }}</label>
        <input class="form-control" type="text" name="street_number" value="{{old('street_number', $location->address->street_number ?? '')}}"
               required autocomplete="street_number" autofocus @error('street_number') is-invalid @enderror>
        @error('street_number')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
    <div class="col-10">
        <label for="street_name" class="form-label">{{ __('address.street_name') }}</label>
        <input class="form-control" type="text" name="street_name" value="{{old('street_name', $location->address->street_name ?? '')}}"
               required autocomplete="street_name" autofocus @error('street_name') is-invalid @enderror>
        @error('street_name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<!--Zip and city-->
<div class="row my-3">
    <!--Zip-->
    <div class="col-6">
        <label for="zip_code" class="form-label">{{ __('address.zip_code') }}</label>
        <input class="form-control" type="text" name="zip_code" value="{{old('zip_code', $location->address->zip_code ?? '')}}"
               required autocomplete="zip_code" autofocus @error('zip_code') is-invalid @enderror>
        @error('zip_code')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
    <!--City-->
    <div class="col-6">
        <label for="city" class="form-label">{{ __('address.city') }}</label>
        <input class="form-control" type="text" name="city" value="{{old('city', $location->address->city ?? '')}}"
               required autocomplete="city" autofocus @error('city') is-invalid @enderror>
        @error('city')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<!--Country-->
@php
    $countries = config('countries');
@endphp
<div class="mt-2 mb-3">
    <label for="country" class="form-label">{{ __('address.country') }}</label>
    <select id="country" class="form-control" name="country" required>
        @php
            $selectedCountry = old('country', $location->address->country ?? null);
        @endphp
        <option disabled {{is_null($selectedCountry)? 'selected':''}}>{{__('address.select_country')}}</option>
        @foreach ($countries as $code => $name)
            <option value="{{ $code }}" {{ $selectedCountry == '$name' ? 'selected' : '' }}>{{__('countries.'.$name) }}</option>
        @endforeach
    </select>
</div>

