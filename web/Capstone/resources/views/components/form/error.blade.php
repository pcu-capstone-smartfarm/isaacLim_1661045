@props(['name'])

@error($name)
    <p dusk="form-error" class="text-red-500 text-xs mt-2">{{ $message }}</p>
@enderror
