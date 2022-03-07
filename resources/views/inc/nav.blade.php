  <nav  class=" padding_none border w-100 d-flex justify-content-center fixed-top navbar navbar-expand-lg navbar-light bg-white " style="padding-bottom: 0;padding-top: 0;">
      <div class="container d-flex justify-content-center" style="padding-bottom: 0;padding-top: 0;">
        <div class="row w-100 ">
          <div class="col-lg-12 col-sm-12 ">
            <div style="width:90%;" class="row d-flex  justify-content-between">
              <div class="px-5 d-flex  justify-content-center padding_none">
                <a class="navbar-brand mx-5 margin_none font-brand" style="font-family:var(--cursive); font-size:35px;padding-bottom: 0;"  href="{{route('home')}}">Igram</a>
              </div>
              
              <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            
              <!-- Navbar links -->
              <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                  <li class="nav-item px-2">
                    <form class="mt-3" action="{{route('profile_search')}}" method="GET">
                      @csrf
                      <div class="d-flex form-group">
                      <input type="text" placeholder="username" name="search" class="form-control w-100">
                        <button class="btn btn-primary ml-2" type="submit">search</button>
                      </div>
                    </form>
                  </li>
                  <li class="nav-item">
                    <a class=" nav-link d-flex justify-content-center"  href="{{route('profile')}}">Profile</a>
                  </li>
                  <li class="nav-item">
                    <a data-bs-toggle="modal" data-bs-target="#createPost" href="#" class="dropdown-item nav-link d-flex justify-content-center ">Create Post</a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="dropdown-item nav-link d-flex justify-content-center"  href="{{route('logout')}}">logout</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        
          {{-- <div class="col-lg-4 dis-none ">
            
              <ul class="navbar-nav  d-flex pt-2 justify-content-center mr-auto">
                <li class="nav-item  active">
                  <form action="{{route('profile_search')}}" method="GET">
                    @csrf
                    <div class="d-flex form-group">
                    <input type="text" placeholder="username" name="search" class="form-control w-100">
                      <button class="btn btn-primary ml-2" type="submit">search</button>
                    </div>
                  </form>
                </li>
                
                
                
              </ul> 
           
          </div> --}}
          {{-- <div class="col-lg-4 dis-none  col-sm-6 w-25 padding_none d-felx align-items-end">
            <div class="d-flex h-100 d-flex justify-content-center align-items-center">
              <div class="px-2"><a href="{{route('home')}}" style="font-size: 18px;" class="text-dark nav-button " ><i class="fas fa-lg fa-home"></i></a></div>
              <div class="px-2"><a href="#" style="font-size: 18px;" class="nav-button text-dark "><i class="fab fa-lg fa-facebook-messenger"></i></a></div>
              <div class="px-2"><a data-bs-toggle="modal" data-bs-target="#createPost" href="#" style="font-size: 18px;" class="nav-button  text-dark "><i class="far fa-lg fa-plus-square"></i></a></div>
              <div class="px-2"><a href="#" style="font-size: 18px;" class="nav-button text-dark "><i class="far fa-lg fa-compass"></i></a></div>
              <div class="px-2"><a href="#" style="font-size: 18px;" class="nav-button text-dark "><i class="far fa-lg fa-heart"></i></a></div>
              <a href="#"  style="width: 10%;" class="w-25">
                <img class="rounded-circle mx-auto d-block img-sm" src="data:image/jpeg;base64,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" alt="im">
              </a>
              <ul class="navbar-nav  d-flex justify-content-center ">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle"   href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img style="width:40px;height: 40px; border-radius: 50%" src="/storage/profile_pic/{{auth()->user()->profile->profile_pic}}" alt="user_profile_img">    
                  </a>
                  <div class="dropdown-menu"  aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="{{route('profile')}}">profile</a>
                    <a class="dropdown-item"  href="{{route('logout')}}">logout</a>
                  </div>
                </li>
              </ul>
              
            </div>
          
        
          </div> --}}
        </div>
      </div>
  </nav>

  <div class="modal fade mt-5" id="createPost" tabindex="-1" aria-labelledby="createPostLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-center">
          <h3 class="modal-title d-flex justify-content-center" id="createPostLabel">Create Post</h3>
        </div>
        <div class="modal-body">
          <form  action="{{ route('post')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group"><input type="file" name="post_pic" placeholder="Add a Post " class="py-2 form-control"></div>              
              <div class="form-group"><textarea name="post_desc" id="" cols="50" class="w-100 " placeholder="Add Post description"></textarea></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary"></input>
          </form>
        </div>
      </div>
    </div>
  </div>