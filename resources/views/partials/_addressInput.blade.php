<br>
<h5 class="text-secondary">{{__('address.address')}}</h5>
<hr>

<!--Street number and name-->
<div class="row my-3">
    <div class="col-2">
        <label for="street_number" class="form-label">{{ __('address.street_number') }}</label>
        <input class="form-control @error('street_number') is-invalid @enderror" type="text" name="street_number" value="{{old('street_number', $addressOld->street_number ?? '')}}"
               required autocomplete="street_number">
        @error('street_number')
        <span class="invalid-feedback" role="alert">
                                        {{__('address.street_number_required')}}
                                    </span>
        @enderror
    </div>
    <div class="col-10">
        <label for="street_name" class="form-label">{{ __('address.street_name') }}</label>
        <input class="form-control @error('street_name') is-invalid @enderror" type="text" name="street_name" value="{{old('street_name', $addressOld->street_name ?? '')}}"
               required autocomplete="street_name" >
        @error('street_name')
        <span class="invalid-feedback" role="alert">
                                        {{__('address.street_name_required')}}
                                    </span>
        @enderror
    </div>
</div>

<!--Zip and city-->
<div class="row my-3">
    <!--Zip-->
    <div class="col-6">
        <label for="zip_code" class="form-label">{{ __('address.zip_code') }}</label>
        <input class="form-control @error('zip_code') is-invalid @enderror" type="text" name="zip_code" value="{{old('zip_code', $addressOld->zip_code ?? '')}}"
               required autocomplete="zip_code">
        @error('zip_code')
        <span class="invalid-feedback" role="alert">
                                        {{__('address.zip_code')}}
                                    </span>
        @enderror
    </div>
    <!--City-->
    <div class="col-6">
        <label for="city" class="form-label">{{ __('address.city') }}</label>
        <input class="form-control @error('city') is-invalid @enderror" type="text" name="city" value="{{old('city', $addressOld->city ?? '')}}"
               required autocomplete="city">
        @error('city')
        <span class="invalid-feedback" role="alert">
                                        {{__('address.city_required')}}
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
    <select id="country" class="form-control @error('country') is-invalid @enderror" name="country" required>
        @php
            $selectedCountry = old('country', $addressOld->country ?? null);
        @endphp
        <option disabled {{is_null($selectedCountry)? 'selected':''}}>{{__('address.select_country')}}</option>
        @foreach ($countries as $code => $name)
            <option value="{{ $code }}" {{ $selectedCountry == '$name' ? 'selected' : '' }}>{{__('countries.'.$name) }}</option>
        @endforeach
    </select>
    @error('country')
    <span class="invalid-feedback">
                                        {{__('address.country_required')}}
                                    </span>
    @enderror
</div>
