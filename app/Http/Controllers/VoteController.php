<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(CommunityLink $link)
    {
        $user = auth()->user();
        if($user->votedFor($link)){
            $user->unvoteFor($link);
            return back();
        }
        $user->voteFor($link);
        return back();
    }
}
