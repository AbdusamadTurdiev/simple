<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';

    protected $fillable = [
        'body',
    ];

    protected $appends = ['liked', 'count'];

    public function isLiked()
    {
        return ! ! $this->likes->where('user_id', auth()->id())->count();
    }

    public function getLikedAttribute()
    {
        return $this->isLiked();
    }

    public function getCountAttribute()
    {
        return $this->likes->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    public function replies()
    {
        return $this->hasMany('App\Status', 'parent_id');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
}
