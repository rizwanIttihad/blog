<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','body','is_liked','user_id','likes_count','liked_by'];

    // protected $casts = [
    //     'liked_by' => 'array'
    // ];

    public function user(){
       return $this->belongsto(User::class);
    }

    public function postLikeBy(){
        return $this->hasMany(PostLikeBy::class);
    }

}
