<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Category;
use App\Comment;

class Post extends Model
{
    //

    //protected $casts = [
      //'category_id' => 'array',
    //];

    public function user() {
    
        return $this->belongsTo(User::class);
    }

    public function category() {

        return $this->belongsTo(Category::class);
        
    }

    public function comments() {

        return $this->hasMany(Comment::class);

    }

}