<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityLinkRequest;
use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinkController extends Controller
{
    public function index(Channel $channel = null)
    {
        $order = request()->has('popular') ? 'vote_count' : 'updated_at';
        $links = CommunityLink::forChannel($channel)
            ->where('approved', 1)
            ->withCount('votes')
            ->leftJoin('votes', 'votes.community_link_id', '=', 'community_links.id')
            ->selectRaw(
                'community_links.*, count(votes.id) as vote_count'
            )
            ->groupBy('community_links.id')
            ->orderBy($order, 'desc')
            ->paginate(5);
        return view('community.index', compact('links', 'channel'));
    }

    public function store(StoreCommunityLinkRequest $request)
    {
        if ($link = CommunityLink::where('link', $request->link)->first()) {
            $link->touch();
            return back()->with('success', 'Community link created before and updated now');
        }
        $attributes = $request->validated();
        $attributes['user_id'] = auth()->id();
        $attributes['approved'] = auth()->user()->isTrusted() ? 1 : 0;
        CommunityLink::create($attributes);
        return back()->with('success', 'Community link created successfully');
    }
}
