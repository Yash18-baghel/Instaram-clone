<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function index(){
        return view('Auth.register');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:100',
            'username' => 'required|unique:users|max:100',
            'email' => 'required|unique:users|email|max:100',
            'password' => 'required|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        // $profile = new Profile::create([
        //     'desc' => ' ',
        //     'profile_pic' => ' ',
        // ]);
        
        $user->profile()->save(new Profile);
        

        auth()->attempt($request->only('email','password'));
        $fileNameToStore = 'no_img.png';
            $profile = new Profile;
            // dd($request->input('desc'));
            $profile = auth()->user()->profile;
            $profile->profile_pic = $fileNameToStore;
            $profile->desc = ' ';
            $profile->save();
        return redirect()->route('home');
    }
}
