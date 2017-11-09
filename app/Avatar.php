<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = [
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
