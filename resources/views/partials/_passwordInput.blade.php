<br>
<h5 class="text-secondary">{{__('user.password')}}</h5>
<hr>
<!--Passwords-->
<div class="row my-3">
    <div class="col-6">
        <label for="password" class="form-label">{{ __('user.password') }}</label>
        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
               value="{{old('password')}}"
               required autocomplete="new-password" >
        @error('password')
        <span class="invalid-feedback" role="alert">
                                        {{__('user.password_required')}}
                                    </span>
        @enderror
    </div>
    <div class="col-6">
        <label for="password_confirmation"
               class="form-label">{{ __('user.password-confirm') }}</label>
        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation"
               id="password_confirmation"
               required>
        @error('password_confirmation')
        <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
        @enderror
    </div>
</div>
