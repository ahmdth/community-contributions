@props(['name'])
<div class="form-group mb-3">
    <label for="{{ $name }}" class="text-capitalize">{{ $name }}</label>
    <input {{ $attributes->merge(['type'=>'text', 'name'=>$name, 'class'=>'form-control', 'value'=> old($name)]) }} />
    <x-error :name="$name"/>
</div>
