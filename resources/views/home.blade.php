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
        .scroll::-webkit-scrollbar {
            display: none;
        }

        :root{
            --cursive:'Oleo Script', cursive;
            --font2:'Roboto', sans-serif;
        }   
        h1{
            font-family: var(--cursive);
        }
    </style>
    <title>Igram</title>
</head>
<body>
        @include('inc.nav')
        {{-- <p>{{auth()->user()->name}}</p> --}}
        <div class="container px-5">
            <div class="mt-4 p-5 row">
                <div class="col-md-8">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="border">
                                lsahdg  jd
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            @foreach ($posts as $post)
                            <div class="card mt-3">
                                <div class="card-header bg-white " style="padding:10px 0;">
                                    <a href="user_profile/{{ $post->user->id }}"  class="mx-3  text-dark"><img class="mr-2"  style="width:30px;height: 30px; border-radius: 50%" src="/storage/profile_pic/{{$post->user->profile->profile_pic}}" alt="user_profile_img">{{$post->user->username}}</a>
                                </div>
                                <img style="border-radius: 0"  src="/storage/post_pic/{{$post->post_pic}}" alt="" class="card-img img-fluid">
                                @php
                                    $var = 0;
                                @endphp
                                <div class="row   px-3 mt-4">
                                        <div class="col-sm-12 ">
                                            <div class="row pl-2">
                                                <div class="px-2">
                                                <a href="{{url('post_like',[auth()->user()->id,$post->id])}} " class="text-dark">
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
                                                    
                                                </a>
                                            </div>
                                                <div class="px-2"><a href="#" data-bs-toggle="modal" data-bs-target="#showPost{{$post->id}}" class="text-dark"><i class="far fa-lg fa-comment"></i></a></div>
                                                <div class="px-2"><a href="/test" class="text-dark"><i class="fab fa-lg fa-telegram-plane"></i></a></div>
                                            </div>
                                        </div>
                                        <div class="modal fade" style="background-color:rgba(255, 255, 255, 0.3);backdrop-filter: blur(2px)" id="showPost{{$post->id}}" tabindex="-1" aria-labelledby="showPost{{$post->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl mt-5" style="width:1000px" role="document">
                                              <div class="modal-content" style="height:500px;width:500px">
                                                
                                                <div class="modal-body" style="padding:0;">
                                                  <div class="row h-100" >
                                                      <div class="col-sm-6" style="padding-right: 0">
                                                          <img src="/storage/post_pic/{{$post->post_pic}}" style="height:100%" alt="" class="img-fluid">
                                                      </div>
                                                      <div class="col-sm-6" style="padding-left: 0">
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
                                        <div class="col-12">
                                            <div class="py-1"><strong>{{count($post->likes)}} likes</strong></div>
                                        </div>
                                        @if (isset( $post->post_desc ))
                                            <div class="col-12">
                                                <p class=""><b><a class="text-dark" href="user_profile/{{ $post->user->id }}">{{$post->user->username}}</a></b> {{$post->post_desc}}</p>
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <p class=" text-muted">
                                                @if ($post->created_at->diffInDays() > 30)
                                                    {{ $post->created_at->toFormattedDateString()}}
                                                @else
                                                    {{$post->created_at->diffForHumans()}}
                                                @endif
                                            </p>
                                        </div>

                                        <div class="col-12">
                                            <form action="{{ route('post_cmnt',$post->id) }}" class="form-group"  method="POST">
                                                @csrf
                                                
                                                <div  class="input-group">
                                                    
                                                    <textarea placeholder="add comment..." id="Cmnt_Txt{{$post->id}}" name="cmnt" class="form-control custom-control" plane rows="1" style="resize:none"></textarea>     
                                                    <button  type="submit" id="Submit_Txt{{$post->id}}" class="input-group-addon btn hover" style="border:1px solid gray; border-radius: 0 5px 5px 0">comment</a>        
                                                
                                                    </div>
                                            </form>
                                        </div>
                                </div>
                                
                            </div>
                           
                                 
                            @endforeach    
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div >hd</div>
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