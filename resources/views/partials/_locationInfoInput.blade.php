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

@include('partials._addressInput',['addressOld' => $location->address])

