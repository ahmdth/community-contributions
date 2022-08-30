@props(['items', 'name'])
<div class="form-group mb-3">
    <label for="channel">{{ $name }}</label>
    <select class="form-select" name="{{ $name }}">
        <option disabled selected>Select channel</option>
        @foreach($items as $item)
            <option value="{{ $item->id }}" @selected(old('channel_id') == $item->id)>{{ $item->title }}</option>
        @endforeach
    </select>
    <x-error :name="$name"/>
</div>
