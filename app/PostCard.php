<?php

namespace App;
use App\Media;
use App\User;

use Illuminate\Database\Eloquent\Model;

class PostCard extends Model
{
    protected $table ="postcards";


    public function medias()
    {
        return $this->hasMany(Media::class, 'postcard_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
