@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>
                    <a href="/community">Community</a>
                    @if($channel)
                        <span style="background-color: {{ $channel->color }};"
                              class="px-2 text-white rounded">
                            {{ $channel->title }}
                        </span>
                    @endif
                </h3>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->has('popular')? '': 'active bg-white' }}"
                           aria-current="page"
                           href="{{ request()->url() }}">Most Recent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->has('popular')? 'active bg-white' : '' }}" href="?popular">
                            Most popular
                        </a>
                    </li>
                </ul>
                <ul class="list-group">
                    @forelse($links as $link)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                                <form action="{{ route('votes.store', $link) }}"
                                      method="post"
                                      style="margin-right: 16px">
                                    @csrf
                                    <button type="submit"
                                            class="btn {{ (auth()->check() && auth()->user()->votedFor($link))? 'btn-success' : 'btn-outline-success' }}">
                                        {{ $link->votes_count }}
                                    </button>
                                </form>
                                <div class="d-flex flex-column">
                                    <a class="h5 fw-bold" href="{{ $link->link }}"
                                       target="_blank">{{ $link->title }}</a>
                                    <span class="text-sm">
                        Contributed by: {{ $link->creator->name }}
                        <span
                            style="font-size: 13px">{{ \Carbon\Carbon::make($link->updated_at)->diffForHumans() }}</span>
                    </span>
                                </div>
                            </div>
                            <a href="{{ route('links.index', $link->channel) }}"
                               style="background-color: {{ $link->channel->color }};font-size: 13px"
                               class="text-white px-2 p-1 rounded text-uppercase"
                            >{{ $link->channel->title }}</a>
                        </li>
                    @empty
                        <li>No contributions</li>
                    @endforelse
                    <div class="my-3">
                        {{ $links->links() }}
                    </div>
                </ul>
            </div>
            @auth
                <div class="col-md-4">
                    <x-create-link :channels="$channels"/>
                </div>
            @endauth
        </div>
    </div>
@endsection
