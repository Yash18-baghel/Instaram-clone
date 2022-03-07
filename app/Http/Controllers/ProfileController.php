<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Models\Post;
use App\Models\follows;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
// use Image;

class ProfileController extends Controller
{
    public function index(){
       $id = auth()->user()->id;
       $user = User::find($id);
       $posts = Post::where("user_id", "=", $user->id)->get();
    //    $follower = follows::where("following_id", "=", $user->id)->get();
    //    $following = follows::where("follower_id", "=", $user->id)->get();
    //    return view('profile',['user' => $user,'posts' => $posts,'follower' => $follower,'following' => $following]);
    
       

       $followers = follows::where("following_id", "=", $user->id)->get();
        $arr1 = [];
        $i = 0;
        foreach ($followers as $follower){
            $arr1[$i++] = $follower->follower_id;   
        }
        $follows  = follows::where("follower_id", "=", auth()->user()->id)->where("following_id", "=", $user->id)->get();

        $followings = follows::where("follower_id", "=", $user->id)->get();
        $arr2 = [];
        $j = 0;
        foreach ($followings as $following){
            $arr2[$j++] = $following->following_id;   
        }
        $follower_profiles = Profile::wherein("user_id",$arr1)->get();
        $following_profiles = Profile::wherein("user_id",$arr2)->get();
        // dd($followers);  
        return view('profile',['user' => $user,'posts' => $posts,'followers' => $followers,'followings' => $followings,'follows' => $follows,'follower_profiles' => $follower_profiles,'following_profiles' => $following_profiles]);
    
    }
    public function follow($id){
        // dd($id);
            

            if(isset($_GET['follow'])){
                $follow = new follows;
                $follow->follower_id = auth()->user()->id;
                $follow->following_id = $id;
                $follow->save();
                return redirect()->back();
            }
            if(isset($_GET['unfollow'])){
                follows::where("following_id", "=", $id)->where("follower_id", "=", auth()->user()->id)->delete();
                return redirect()->back();
            }
            

    }
    public function user_profile($username){  

        // dd($id);
        $user = User::where('username',$username)->first();
        // dd($user->id);
        $posts = Post::where("user_id", "=", $user->id)->get();
        $followers = follows::where("following_id", "=", $user->id)->get();
        $arr1 = [];
        $i = 0;
        foreach ($followers as $follower){
            $arr1[$i++] = $follower->follower_id;   
        }
        $follows  = follows::where("follower_id", "=", auth()->user()->id)->where("following_id", "=", $user->id)->get();

        $followings = follows::where("follower_id", "=", $user->id)->get();
        $arr2 = [];
        $j = 0;
        foreach ($followings as $following){
            $arr2[$j++] = $following->following_id;   
        }
        $follower_profiles = Profile::wherein("user_id",$arr1)->get();
        $following_profiles = Profile::wherein("user_id",$arr2)->get();
        // dd($followers);  
        return view('profile',['user' => $user,'posts' => $posts,'followers' => $followers,'followings' => $followings,'follows' => $follows,'follower_profiles' => $follower_profiles,'following_profiles' => $following_profiles]);
    }

    public function search(Request $request){
        
        // dd($_GET['search']);
        $user = User::query()
        ->where('username', 'LIKE', "%{$_GET['search']}%") 
        ->first();
        
        if($user != NULL){
            $posts = Post::where("user_id", "=", $user->id)->get();
            $followers = follows::where("following_id", "=", $user->id)->get();
        $arr1 = [];
        $i = 0;
        foreach ($followers as $follower){
            $arr1[$i++] = $follower->follower_id;   
        }
        $follows  = follows::where("follower_id", "=", auth()->user()->id)->where("following_id", "=", $user->id)->get();

        $followings = follows::where("follower_id", "=", $user->id)->get();
        $arr2 = [];
        $j = 0;
        foreach ($followings as $following){
            $arr2[$j++] = $following->following_id;   
        }
        $follower_profiles = Profile::wherein("user_id",$arr1)->get();
        $following_profiles = Profile::wherein("user_id",$arr2)->get();
        // dd($followers);  
        return view('profile',['user' => $user,'posts' => $posts,'followers' => $followers,'followings' => $followings,'follows' => $follows,'follower_profiles' => $follower_profiles,'following_profiles' => $following_profiles]);
        }
        else{
            return "no result found";
        }
        
    }
    public function change(Request $request)
    {
        $this->validate($request, [
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable|max:1999',
            'username' => 'unique:users|max:100',
        ]);
        
        // dd($request->input('desc'),$request->input('username'));

        // Handle File Upload
        
        // Handle File Upload
        if($request->hasFile('profile_pic')){
            // Get the file name with extension

            $filenameWithExt = $request->file('profile_pic')->getClientOriginalName();

            // Get just filename

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);


            // Get just ext
            $extension  = $request->file('profile_pic')->getClientOriginalExtension();

            // filename To Store
            $fileNameToStore = $filename.'_'.time().$extension;


            // Upload image
            $path = $request->file('profile_pic')->storeAs('public/profile_pic',$fileNameToStore);


            $profile = new Profile;
            $profile = auth()->user()->profile;
            $profile->profile_pic = $fileNameToStore;
            $profile->save();
        }
        
        if($request->input('desc')!=NULL){
            $profile = new Profile;
            // dd($request->input('desc'));
            $profile = auth()->user()->profile;
            $profile->desc = $request->input('desc');
            $profile->save();
        }
        if ($request->input('username')!=NULL){
            auth()->user()->username = $request->input('username');
            auth()->user()->save();
        }
        if($request->has('remove')){
            // dd('sljkdgha');
            $fileNameToStore = 'no_img.png';
            $profile = new Profile;
            // dd($request->input('desc'));
            $profile = auth()->user()->profile;
            $profile->profile_pic = $fileNameToStore;
            $profile->save();
        }
        return redirect('/profile');
        
    }

}
