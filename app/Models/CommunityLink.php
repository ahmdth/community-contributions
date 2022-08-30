<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['creator', 'channel'];
    protected $casts = ['approved' => 'boolean'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'community_link_id');
    }

    public function scopeForChannel($query, $channel)
    {
        if ($channel){
            return $query->where('channel_id', $channel->id);
        }
        return $query;
    }
}
