<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Likes;
use App\Models\Post_cmnt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
        
        //dd($posts);
        return view('post');
        
    }
    public function show($username,$post_id){
        $user = User::where('username',$username)->first();
        $post =    Post::where('user_id',$user->id)->where('id',$post_id)->first();
        return view('show',['post' => $post,'user' => $user]);
    }

    public function store(Request $request){
        // dd($request->post_desc);
        $this->validate($request,[
            'post_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1999',
            
        ]);
        // dd($request->input('post_desc'));
        if($request->hasFile('post_pic')){
            // Get the file name with extension

            $filenameWithExt = $request->file('post_pic')->getClientOriginalName();

            // Get just filename

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);


            // Get just ext
            $extension  = $request->file('post_pic')->getClientOriginalExtension();

            // filename To Store
            $fileNameToStore = $filename.'_'.time().$extension;


            // Upload image
            $path = $request->file('post_pic')->storeAs('public/post_pic',$fileNameToStore);
            // dd($request->post_desc);
            $request->user()->post()->create([
                'post_desc' => $request->post_desc,
                'post_pic' => $fileNameToStore,
            ]);


            // $profile = new Profile;
            // $profile = auth()->user()->profile;
            // $profile->profile_pic = $fileNameToStore;
            // $profile->save();
        }

        return Redirect()->back();
    }
    public function like($user_id,$post_id){
        $x =  Likes::where('user_id',$user_id)->where('post_id',$post_id)->get();
        if(count($x) == 0){
            $Likes = new Likes;
            $Likes->user_id = $user_id; 
            $Likes->post_id = $post_id;
            $Likes->save();
        }
        else{
            Likes::where('user_id',$user_id)->where('post_id',$post_id)->delete();
            // $x->delete();
        }
        return Redirect()->back();
    }
    public function comment(Request $request,$post_id){
        if($request->input('cmnt')!=NULL){  
            $comment = new Post_cmnt;
            $comment->parent_id = NULL;
            $comment->user_id = auth()->user()->id; 
            $comment->post_id = $post_id;
            $comment->comment = $request->input('cmnt');
            $comment->save();
        }
        return Redirect()->back();
    }
    public function reply(Request $request,$id,$post_id){
        // return 'k';
        if($request->input('cmnt')!=NULL){  
            $comment = new Post_cmnt;
            $comment->parent_id = $id;
            $comment->user_id = auth()->user()->id; 
            $comment->post_id = $post_id;
            $comment->comment = $request->input('cmnt');
            $comment->save();
        }
        return Redirect()->back();
    }


}
