<select class="input" name="country" required>
    <option value="">Select country</option>
    @foreach($countries as $country)
        <option value="{{ $country }}" @selected(old('country') === $country)>{{ $country }}</option>
    @endforeach
</select>
@error('country')
    <p class="form-error">{{ $message }}</p>
@enderror
