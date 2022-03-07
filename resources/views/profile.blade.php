<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet"> 
    <style>
        .user-img{
            background-attachment: fixed;
            background-position:center;
            background-repeat:no-repeat;
            background-size:cover;
        }
        @import url('https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Oleo+Script&family=Roboto&display=swap');

        :root{
            --cursive:'Oleo Script', cursive;
            --font2:'Roboto', sans-serif;
        }   
        h1{
            font-family: var(--cursive);
        }
        @media only screen and (max-width: 1000px) {
          /* For mobile phones: */
          .container{
              padding:0 !important;
              margin:0 !important;
          }
          .font-brand{
              font-size: 24px !important;
          }
          .nav-button{
              font-size: 15px !important;
          }
          .column-4{
              columns: 2 auto !important;
          }
          .dis-none{
              display: none;
          }
          #id{
            /* background-color: red; */
          }
          #img{
              width: 80px !important; 
              height:80px !important; 
          }
          .padding_none{
              padding: 0 !important;
          }
          .margin_none{
              margin: 0 !important;
          }
          .cont-mt{
            margin-top:80px !important;
          }
          .container-ht{
              height: 40vh !important;
          }
          .post-max-ht{
              max-height: 70% !important;
          }
        }
    </style>
    <title>Igram</title>
</head>
<body style="background: #FAFAFA">
    @include('inc.nav')
    <div class=" padding_none margin_none mt-5 pt-5 px-5">
        <div   class="cont-mt row w-100 px-5 padding_none margin_none container-ht" style="border-bottom: 1px solid gray">
            {{-- @error('username')
                <div class="text-danger my-1 text-sm" >
                    {{$message}}
                </div>
            @enderror
            @error('profile_pic')
                <div class="text-danger my-1 text-sm" >
                    {{$message}}
                </div>
            @enderror
            @error('desc')
                <div class="text-danger my-1 text-sm" >
                    {{$message}}
                </div>
            @enderror --}}
            <div class="row w-100">
                <div class="col-5 p-3" id='id'>
                    <a data-bs-toggle="modal" data-bs-target={{($user->id == auth()->user()->id)?"#chngDP":"#"}} class=" d-flex justify-content-center align-self-center h-100 text-secondary" href="">
                        <img id='img' class=" img-fluid d-flex justify-content-center align-self-start" style="width:200px;height: 200px; border-radius: 50%" src="/storage/profile_pic/{{($user->id == auth()->user()->id)?auth()->user()->profile->profile_pic:$user->profile->profile_pic}}" alt="img">
                    </a>
                    
    
                </div>
                <div class="col-7 padding_none d-flex align-items-center">
                    <h4> {{  ($user->id == auth()->user()->id) ? auth()->user()->username : $user->username }} </h4>
                    @if (($user->id == auth()->user()->id))
                   <h2 class='d-flex justify-content-center'>
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="text-secondary" href=""><i class="fas fa-sm fa-user-edit"></i></a></h5>
                    @else   
                        <form action="profile_follow/{{ $user->id }}" class="display-flex pl-3 pt-3 align-self-center form-group" method="get">
                            @if (!count($follows))
                                <button type="submit" name='follow' class=" btn btn-primary">follow</button>
                            @else
                                <button type="submit" name='unfollow' class=" btn btn-secondary">unfollow</button>
                            @endif
                        </form>
                    @endif
                   </h2>
                </div>
            </div>
            <div class="w-100 mt-4 row" >
               <div class="col-lg-5 dis-none "></div>
               <div class="col-lg-7 col-12">
                   <div class="row">
                    <div class="col-4 col-lg-2 " ><p><strong>{{count($posts)}}</strong> post</p></div>
        
                    <div class="col-4 col-lg-2 padding_none" ><p><strong><a style="text-decoration: none" class="text-dark" href="#" data-bs-toggle="modal" data-bs-target="#follower" >{{count($followers)}}</strong> followers</p> </a></div>
                    <div class="col-4 col-lg-2 padding_none" ><p><strong><a style="text-decoration: none" class="text-dark" href="#" data-bs-toggle="modal" data-bs-target="#following" >{{count($followings)}}</strong> following</p> </a></div>
                    </div>
                    <h6>{{($user->id == auth()->user()->id)?auth()->user()->name:$user->name}}</h6>
                    <p>{{($user->id == auth()->user()->id)?auth()->user()->profile->desc:$user->profile->desc}}
                    </p>
                   </div>
               </div>
        </div>
            
        
        <div class="row px-2 pt-3">
            @if (count($posts))
                @foreach ($posts as $post)
                <div  class=" d-flex justify-content-center col-4 my-5 padding_none margin_none"><a data-bs-toggle="modal" data-bs-target="#showPost{{$post->id}}" class="text-secondary" href="">
                    <img class="img-fluid post-max-ht" style="max-height:400px" src="/storage/post_pic/{{$post->post_pic}}" alt="pic">
                </a></div>
                <div class="modal fade" style="background-color:rgba(255, 255, 255, 0.3);backdrop-filter: blur(2px)" id="showPost{{$post->id}}" tabindex="-1" aria-labelledby="showPost{{$post->id}}Label" aria-hidden="true">
                    <div class="modal-dialog modal-xl mt-5" style="width:1000px" role="document">
                      <div class="modal-content" style="height:500px;width:500px">
                        
                        <div class="modal-body" style="padding:0;">
                          <div class="row h-100" >
                              <div class="col-md-6" style="padding-right: 0;">
                                  <img class="img-fluid " src="/storage/post_pic/{{$post->post_pic}}" style="height:100%" alt="" class="img-fluid">
                              </div>
                              <div class="col-md-6" style="padding-left: 0">
                                <div class="card">
                                    <div class="card-header">
                                        <h6><a href="user_profile/{{ $post->user->id }}"  class="text-dark "><img style="width:30px;height: 30px; border-radius: 50%" src="/storage/profile_pic/{{$post->user->profile->profile_pic}}" alt="user_profile_img">{{$post->user->username}}</a></h6>
                                    </div>
                                    <div  style=" height:290px;overflow-y:auto;overflow-x: hidden;" class="scroll card-body">
                                        
                                        
                                        @if (isset( $post->post_desc ))
                                            <div class="row py-2">
                                                <h6 class="pl-2"><b><a class="text-dark" href="user_profile/{{ $post->user->id }}"class="text-dark "><img style="width:25px;height: 25px; border-radius: 50%" src="/storage/profile_pic/{{$post->user->profile->profile_pic}}" alt="user_profile_img"><span class="pl-1">{{$post->user->username}}</span></a></b> <small style="font-size:15px">{{$post->post_desc}}</small></h6>
                                                {{-- <p onclick="visible()">click me</p> --}}
                                            </div>

                                        @endif
                                            
                                        @foreach ($post->comment as $comment)

                                        @if ($comment->parent_id == NULL)

                                        <div class="row py-2" >
                                            <h6 class="pl-2"><b><a class="text-dark" href="user_profile/{{ $post->user->id }}"class="text-dark "><img style="width:25px;height: 25px; border-radius: 50%" src="/storage/profile_pic/{{$comment->user->profile->profile_pic}}" alt="user_profile_img"><span class="pl-1">{{$comment->user->username}}</span></a></b> <small style="font-size:15px">{{$comment->comment}}</small></h6>
                                            <div class="row w-100">
                                                <div class="col-md-6" style="padding-right: 0">
                                                    <p class=" text-muted">
                                                        @if ($comment->created_at->diffInDays() > 30)
                                                            {{$comment->created_at->toFormattedDateString()}}
                                                        @else
                                                            <small class="pl-3">{{$comment->created_at->diffForHumans()}}</small>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-3 w-50" style="padding-right: 0"><small>likes</small></div>
                                                <div class="col-md-3" style="padding-right: 0;"><p style="cursor: pointer;" id="button{{$comment->id}}" onclick="visible{{$comment->id}}()" href="#"><small>reply</small></a></div>
                                                <form style="display:none" id="reply{{$comment->id}}" action="{{url('cmnt_reply',[ 'comment_id' => $comment->id,'post_id' => $post->id])}}"  class="form-group pl-3"  method="POST">
                                                    @csrf
                                                    <div  class="input-group" >
                                                        
                                                        <textarea style="resize:none" placeholder="add comment..." id="Cmnt_Txt{{$post->id}}" name="cmnt" class="form-control custom-control" plane rows="1"></textarea>     
                                                        <button  type="submit" id="Submit_Txt{{$post->id}}" class="input-group-addon btn hover" style="border:1px solid gray; border-radius: 0 5px 5px 0"><i class="fas fa-angle-double-right"></i></a>        
                                                    
                                                        </div>
                                                </form>
                                                <script>
                                                    function visible{{$comment->id}}(){
                                                        var x = document.getElementById("reply{{$comment->id}}");
                                                        if (x.style.display === "none") {
                                                          x.style.display = "block";
                                                        } else {
                                                          x.style.display = "none";
                                                        }    
                                                    }
                                                </script>

                                            </div>
                                            @foreach ($post->comment as $x)
                                                @if ($x->parent_id == $comment->id)
                                                    
                                                    <div class="row w-100 d-flex justify-content-end" >
                                                        <div class="w-75">
                                                            <h6 class="pl-2"><b><a class="text-dark" href="user_profile/{{ $post->user->id }}"class="text-dark "><img style="width:25px;height: 25px; border-radius: 50%" src="/storage/profile_pic/{{$x->user->profile->profile_pic}}" alt="user_profile_img"><span class="pl-1">{{$x->user->username}}</span></a></b> <small style="font-size:15px">{{$x->comment}}</small></h6>
                                                            <div class="row w-100">
                                                            <div class="col-md-8" style="padding-right: 0">
                                                                <p class=" text-muted">
                                                                    @if ($x->created_at->diffInDays() > 30)
                                                                        {{$x->created_at->toFormattedDateString()}}
                                                                    @else
                                                                        <small class="pl-3">{{$x->created_at->diffForHumans()}}</small>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="col-md-3 w-50" style="padding-right: 0"><small>likes</small></div>
                                                            </div>
                                                        </div>
                            
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                            
                                        @endif
                                        @endforeach
                                        <p>
                                    </div>
                                    <div class="card-footer" style="padding:0; padding:5px 20px" >
                                        <div class="row">
                                            <div class="px-2"><a href="{{url('post_like',[auth()->user()->id,$post->id])}} " class="text-dark">
                                                @php
                                                    $var = 0;
                                                @endphp
                                                @foreach ($post->likes as $x)
                                                        @if ($x->user_id == auth()->user()->id)
                                                            
                                                            @php
                                                                $var = 1;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                @if ($var)
                                                <i class="fas fa-lg fa-heart"></i>
                                                @else
                                                <i class="far fa-lg fa-heart"></i>  
                                                @endif
                                                
                                            </a></div>
                                            <div class="px-2"><a href="#" data-bs-toggle="modal" data-bs-target="#showPost{{$post->id}}" class="text-dark"><i class="far fa-lg fa-comment"></i></a></div>
                                            <div class="px-2"><a href="#" class="text-dark"><i class="fab fa-lg fa-telegram-plane"></i></a></div>
                                        </div>
                                        <div class="row">
                                            <strong class="pl-2">{{count($post->likes)}} likes</strong>
                                        </div>
                                        
                                        <div class="row " style="height:30px;">
                                            <p class=" text-muted pl-2">
                                                @if ($post->created_at->diffInDays() > 30)
                                                    <small>{{$post->created_at->toFormattedDateString()}}</small>
                                                @else
                                                    <small>{{$post->created_at->diffForHumans()}}</small>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="row " >
                                            <form action="{{ route('post_cmnt',$post->id) }}"  class="form-group"  method="POST">
                                                @csrf
                                                
                                                <div  class="input-group" >
                                                    
                                                    <textarea style="margin: 0;resize:none" placeholder="add comment..." id="Cmnt_Txt{{$post->id}}" name="cmnt" class="form-control custom-control" plane rows="1"></textarea>     
                                                    <button  type="submit" id="Submit_Txt{{$post->id}}" class="input-group-addon btn hover" style="border:1px solid gray; border-radius: 0 5px 5px 0"><i class="fas fa-angle-double-right"></i></a>        
                                                
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                        {{-- <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Send message</button>
                        </div> --}}
                      </div>
                    </div>
                </div>
                @endforeach
                
            @endif
            
        </div>
    </div>


<div class="modal fade" style="margin-top: 25vh" id="chngDP" tabindex="-1" aria-labelledby="chngDPLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        {{-- <div class="modal-header d-flex justify-content-center">
          <h3 class="modal-title d-flex justify-content-center" id="chngDPLabel">change Profile</h3>
        </div> --}}
        <div class="modal-body" style="padding:0;">
            <div class="row">

                <div class="col-12" style="padding:0px;">
                    <h5 style="font-weight:bold; font-size:25px; border-bottom:0.1px solid gray ;border-radius:0 ;background-color: transparent;"
                        class="modal-title p-4 d-flex justify-content-center text-center"
                        id="exampleModalLabel">
                        Change Profile Photo</h5>
                </div>


                <div class="col-md-12" style="padding:0px; position: relative;height: 56px; width: 100%;"
                    style="position: relative;overflow: hidden;display: inline-block;"
                    class="upload-btn-wrapper">
                    <p style="outline:0 ; font-weight:bold;font-size:15px; border-bottom:0.1px solid gray ;border-radius:0 ;background-color: transparent;padding-left: 0;padding-right: 0;"
                        class="btn text-primary py-3 btn-white btn-lg btn-block">Upload
                        Photo</p>
                    <form action="{{ route('profile_change')}}" id="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input
                            style="cursor:pointer ;font-size: 1px;position: absolute;left: 0;top: 0;opacity: 0;width:100%;height:100%;"
                            type="file" onchange="this.form.submit()" name="profile_pic" />
                    </form>
                </div>

                @if (auth()->user()->profile->profile_pic != 'no_img.png')

                <div class="col-md-12" style="padding:0px;">

                    <form  action="{{ route('profile_change')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button name="remove" style="z-index:-1;background-color: transparent;font-size:15px;font-weight:bold;"
                                class="btn text-danger btn-white btn-lg py-3 btn-block" type="submit">Remove Current
                                Photo
                        </button>
                    </form>
                </div>
                    
                @endif
            </div>
        </div>
        
      </div>
    </div>
</div>
<div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-center">
          <h3 class="modal-title d-flex justify-content-center" id="exampleModalLabel">change Profile</h3>
        </div>
        <div class="modal-body">
          <form  action="{{ route('profile_change')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group"><input type="text" name="desc" placeholder="Change disrciption" class="py-2 form-control"></div>
              <div class="form-group"><input type="text" name="username" placeholder="Change Username " class="py-2 form-control"></div>
              <div class="form-group"><input type="file" name="profile_pic" placeholder="Change Profile pic " class="py-2 form-control"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary"></input>
          </form>
        </div>
      </div>
    </div>
</div>
<div class="modal fade mt-5" id="follower" tabindex="-1" aria-labelledby="followerLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="width: 350px; ">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-center">
          <h3 class="modal-title d-flex justify-content-center" id="exampleModalLabel">followers</h3>
        </div>
        <div class="modal-body">
            <div style="height: 200px;width: auto;overflow-y:scroll;">
                @foreach ($follower_profiles as $profile)
                        <div class=" px-4 py-2  form-group"><a href="{{route('user_profile',$profile->user->username)}}" class="text-dark"><img style="width25px;height: 25px; border-radius:50%;" class="mr-2" src="/storage/profile_pic/{{$profile->profile_pic}}" alt="profile_pic">{{$profile->user->username}}</a></div>
                @endforeach
            </div>     
        </div>
      </div>
    </div>
</div>
<div class="modal fade mt-5" id="following" tabindex="-1" aria-labelledby="followingLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="width: 350px; ">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-center">
          <h3 class="modal-title d-flex justify-content-center" id="exampleModalLabel">followings</h3>
        </div>
        <div class="modal-body">
            <div style="height: 200px;width: auto;overflow-y:scroll;">
                @foreach ($following_profiles as $profile)
                        <div class=" px-4 py-2  form-group"><a href="{{route('user_profile',$profile->user->username)}}" class="text-dark"><img style="width25px;height: 25px; border-radius:50%;" class="mr-2" src="/storage/profile_pic/{{$profile->profile_pic}}" alt="profile_pic">{{$profile->user->username}}</a></div>
                @endforeach
            </div>     
        </div>
      </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  
<script src="https://kit.fontawesome.com/7caaafb0d5.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>
