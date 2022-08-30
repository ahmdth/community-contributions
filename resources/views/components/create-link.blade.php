@props(['channels'])
<div class="card">
    <div class="card-header">
        Contribute a link
    </div>
    <div class="card-body">
        <form action="{{ route('links.store') }}" method="post">
            @csrf
            <x-form.input name="title" placeholder="Write title..."/>
            <x-form.input name="link" type="url" placeholder="What's your link?"/>
            <x-form.select name="channel_id" :items="$channels" />
            <input type="submit" value="Contribute" class="btn btn-primary btn-sm">
        </form>
    </div>
</div>
