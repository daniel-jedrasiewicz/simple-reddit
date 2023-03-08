<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id'];


    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function getImageAttribute()
    {
        return $this->getMedia('posts')->last();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb_600_300')
            ->crop('crop-center', 600, 300);
        $this->addMediaConversion('thumb_300_200')
            ->crop('crop-center', 300, 200);
        $this->addMediaConversion('thumb_100_100')
            ->crop('crop-center', 100, 100);
        $this->addMediaConversion('thumb_60_60')
            ->crop('crop-center', 60, 60);
    }

    public function votes()
    {
        return $this->hasMany(PostVote::class);
    }

    public function votesThisWeek()
    {
        return $this->hasMany(PostVote::class)->where('post_votes.created_at','>=', now()->subDays(7));
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

}
