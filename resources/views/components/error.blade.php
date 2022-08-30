@props(['name', 'message'])
@error($name)
<div class="text-sm text-danger">
    {{ $message }}
</div>
@enderror
