<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_cmnt extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'comment',
        'post_id',
        'parent_id'
    ];

    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(post::class);
    }
}
