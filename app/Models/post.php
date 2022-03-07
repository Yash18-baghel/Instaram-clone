<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $fillable = [
        'post_pic',
        'post_desc',
    ];


    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function likes(){
        return $this->hasMany(Likes::class);
    }
    public function comment(){
        return $this->hasMany(Post_cmnt::class);
    }
}
