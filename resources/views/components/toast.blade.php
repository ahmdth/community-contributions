@if(session('success'))
    <div x-data="{ shown: true, timeout: null }"
         x-init="() => { clearTimeout(timeout); timeout = setTimeout(() => { shown = false }, 3000);  }"
         x-show.transition.out.opacity.duration.1500ms="shown"
         x-transition:leave.opacity.duration.1500ms
         style="display: none;bottom: 20px; right: 20px;position: fixed;background-color: #c8ffe6;"
        {{ $attributes->merge(['class' => "p-2 border border-success rounded"]) }}>
        {{ session('success') }}
    </div>
@endif
