                            <!--Firstname + lastname-->
                            <div class="row my-3">
                                <div class="col-6">
                                    <label for="name" class="form-label">{{ __('customLabels.firstname') }}</label>
                                    <input class="form-control" type="text" name="name" value="{{old('name', $user->name ?? '')}}"
                                           required autocomplete="name" autofocus @error('name') is-invalid @enderror>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="lname" class="form-label">{{ __('customLabels.lastname') }}</label>
                                    <input class="form-control" type="text" name="lname" value="{{old('lname', $user->lname ?? '')}}"
                                           required autocomplete="lname" @error('lname') is-invalid @enderror>
                                    @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!--email + phone-->
                            <div class="row my-3">
                                <div class="col-6">
                                    <label for="email" class="form-label">{{ __('customLabels.email') }}</label>
                                    <input class="form-control" type="email" name="email" value="{{old('email', $user->email ?? '')}}"
                                           required autocomplete="email" @error('email') is-invalid @enderror>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="phone" class="form-label">{{ __('customLabels.phone') }}</label>
                                    <input class="form-control" type="tel" name="phone" value="{{old('phone', $user->phone ?? '')}}"
                                           required autocomplete="phone" @error('phone') is-invalid @enderror>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!--Birthday + gender-->
                            <div class="row my-3">
                                <div class="col-6">
                                    <label for="birthday" class="form-label">{{ __('customLabels.birthday') }}</label>
                                    <input class="form-control" type="date" name="birthday" value="{{old('birthday', $user->birthday ?? '')}}"
                                           required autocomplete="birthday" @error('birthday') is-invalid @enderror>
                                    @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="gender" class="form-label">{{ __('customLabels.gender') }}</label>
                                    <select class="form-select" name="gender"
                                            required @error('gender') is-invalid @enderror>
                                        @php
                                            $selectedGender = old('gender', $user->gender ?? null);
                                        @endphp
                                        <option disabled {{is_null($selectedGender)? 'selected':''}}>{{ __('customLabels.choose')}}</option>
                                        <option value="male" {{ $selectedGender == 'male' ? 'selected' : '' }}>{{__('customLabels.male')}}</option>
                                        <option value="female" {{ $selectedGender == 'female' ? 'selected' : '' }}>{{__('customLabels.female')}}</option>
                                        <option value="other" {{ $selectedGender == 'other' ? 'selected' : '' }}>{{__('customLabels.other')}}</option>

                                        {{-- Implement when gender table exists (remember controller)
                                        @foreach($genders as $id => $gender)
                                            <option value="{{$id}}" {{old('gender') == $id? 'selected' : ''}}>{{ trans('customLabels.' . $gender->name)}}</option>
                                        @endforeach --}}

                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </select>
                                </div>
                            </div>
