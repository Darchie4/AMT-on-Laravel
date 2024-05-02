<div class="col-md-6 mb-2">
    <label for="name" class="form-label ">{{__('pricing.name')}}</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $pricingStructure->name ?? '')}}"
           required autocomplete="name">
    @error('name')
    <span class="invalid-feedback">
                                        {{__('pricing.name_required')}}
                                    </span>
    @enderror
</div>
<div class="col-md-6 mb-2">
    <label for="price" class="form-label">{{__('pricing.price')}}</label>
    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price', $pricingStructure->price ?? '')}}"
           required autocomplete="price">
    @error('price')
    <span class="invalid-feedback">
                                        {{__('pricing.price_required')}}
                                    </span>
    @enderror
</div>
<div class="row row-cols-2">
    <div class="col-md-6 mb-2">
        <label for="payment_frequency" class="form-label">{{__('pricing.frequency')}}</label>
        <select required class="form-select @error('payment_frequency') is-invalid @enderror" name="payment_frequency">
            @php
                $selectedFrequency = old('payment_frequency', $pricingStructure->payment_frequency ?? null);
            @endphp
            <option disabled {{is_null($selectedFrequency)? 'selected':''}}>{{ __('pricing.choose')}}</option>
            <option
                value="weekly" {{ $selectedFrequency == 'weekly' ? 'selected' : '' }}>{{__('pricing.weekly')}}</option>
            <option
                value="monthly" {{ $selectedFrequency == 'monthly' ? 'selected' : '' }}>{{__('pricing.monthly')}}</option>
            <option
                value="quarterly" {{ $selectedFrequency == 'quarterly' ? 'selected' : '' }}>{{__('pricing.quarterly')}}</option>
            <option
                value="biannually" {{ $selectedFrequency == 'biannually' ? 'selected' : '' }}>{{__('pricing.biannually')}}</option>
            <option
                value="annually" {{ $selectedFrequency == 'annually' ? 'selected' : '' }}>{{__('pricing.annually')}}</option>
        </select>
        @error('payment_frequency')
        <span class="invalid-feedback">
                                        {{__('pricing.payment_frequency_required')}}
                                    </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-auto mb-2">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="collapse"
                data-bs-target="#AdvancedInput">{{ __('pricing.advanced') }}</button>
    </div>
    <div class="col-md-auto">
        <div id="AdvancedInput" class="collapse">
            <div class="input-group">
            <input class="form-control" type="number" id="frequency" name="frequency_multiplier" value="{{old('frequency_multiplier', $pricingStructure->frequency_multiplier ?? 1) }}">
            <span class="input-group-text">
                <i class="fas fa-question-circle" data-bs-toggle="tooltip" title="{{__('pricing.frequency_multiplier_tooltip')}}"></i>
            </span>
            </div>
        </div>
    </div>
</div>





