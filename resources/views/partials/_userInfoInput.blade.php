<!--Firstname + lastname-->
<div class="row my-3">
    <div class="col-6">
        <label for="name" class="form-label">{{ __('customLabels.firstname') }}</label>
        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{old('name', $user->name ?? '')}}"
               required autocomplete="name"  >
        @error('name')
        <span class="invalid-feedback" role="alert">
                                        {{__('user.name_required')}}
                                    </span>
        @enderror
    </div>
    <div class="col-6">
        <label for="lname" class="form-label">{{ __('customLabels.lastname') }}</label>
        <input class="form-control  @error('lname') is-invalid @enderror" type="text" name="lname" value="{{old('lname', $user->lname ?? '')}}"
               required autocomplete="lname">
        @error('lname')
        <span class="invalid-feedback" role="alert">
                                        {{__('user.lname_required')}}
                                    </span>
        @enderror
    </div>
</div>
<!--email + phone-->
<div class="row my-3">
    <div class="col-6">
        <label for="email" class="form-label">{{ __('customLabels.email') }}</label>
        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email', $user->email ?? '')}}"
               required autocomplete="email" >
        @error('email')
        <span class="invalid-feedback" role="alert">
                                        {{__('user.email_required')}}
                                    </span>
        @enderror
    </div>
    <div class="col-6">
        <label for="phone" class="form-label">{{ __('customLabels.phone') }}</label>
        <input class="form-control @error('phone') is-invalid @enderror" type="tel" name="phone" value="{{old('phone', $user->phone ?? '')}}"
               required autocomplete="phone" >
        @error('phone')
        <span class="invalid-feedback" role="alert">
                                        {{__('user.phone_required')}}
                                    </span>
        @enderror
    </div>
</div>
<!--Birthday + gender-->
<div class="row my-3">
    <div class="col-6">
        <label for="birthday" class="form-label">{{ __('customLabels.birthday') }}</label>
        <input class="form-control @error('birthday') is-invalid @enderror" type="date" name="birthday" value="{{old('birthday', $user->birthday ?? '')}}"
               required autocomplete="birthday" >
        @error('birthday')
        <span class="invalid-feedback" role="alert">
                                        {{__('user.birthday_required')}}
                                    </span>
        @enderror
    </div>
    <div class="col-6">
        <label for="gender" class="form-label">{{ __('customLabels.gender') }}</label>
        <select class="form-select @error('gender') is-invalid @enderror" name="gender"
                required >
            @php
                $selectedGender = old('gender', $user->gender ?? null);
            @endphp
            <option disabled {{is_null($selectedGender)? 'selected':''}}>{{ __('customLabels.choose')}}</option>
            <option value="male" {{ $selectedGender == 'male' ? 'selected' : '' }}>{{__('customLabels.male')}}</option>
            <option
                value="female" {{ $selectedGender == 'female' ? 'selected' : '' }}>{{__('customLabels.female')}}</option>
            <option
                value="other" {{ $selectedGender == 'other' ? 'selected' : '' }}>{{__('customLabels.other')}}</option>
            @error('gender')
            <span class="invalid-feedback" role="alert">
                                        {{__('user.gender_required')}}
                                    </span>
            @enderror
        </select>
    </div>
</div>
