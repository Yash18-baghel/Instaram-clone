<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\follows;

use App\Models\Profile;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    public function index(){

        $followers = follows::where("follower_id", "=", auth()->user()->id)->get();
        $arr = [];
        $i=0;

        foreach ($followers as $follower){
            $arr[$i++] = $follower->following_id;
        }
        $posts = post::whereIn('user_id', $arr)->get();
        // $like = 
        // $Profiles = DB::table('profiles')
        //     -> whereIn('user_id', $arr)
        //     ->get();
        // $users = DB::table('users')
        //     -> whereIn('id', $arr)
        //     ->get();
        return view('home',['posts' => $posts]);
    }
}