<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Oleo+Script&family=Roboto&display=swap');

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
<body class="bg-white">
    <div class="container">
        <div class="row mt-5 d-flex justify-content-center">
            <div class=" my-4 py-1 card " >
                <div class="card-body " style="padding: 0 15%" >
                    <h1 class="text-center">Igram</h1>
                    <p class="text-muted text-bold text-center" style="font-family: var(--font2); font-weight: bold">
                        Sign up to see photos and videos from your friends.
                    </p>
                    <form action="#" method="post" class="form-group">
                        @csrf

                        @if (session('status'))
                            <div class="alert alert-danger text-center ">
                                {{session('status')}}
                            </div>
                        @endif

                        <div class="form-group"> <input value="{{old('email')}}" type="email" id="email" name="email" class="form-control @error('email') border-danger @enderror" placeholder="Enter Your Email"></div>
                        @error('email')
                            <div class="text-danger my-1 text-sm" >
                                {{$message}}
                            </div>
                        @enderror
                        
                        
                        <div class="form-group">
                            <input type="password" value=""  id="password" name="password" class="form-control @error('password') border-danger @enderror" placeholder="Enter Your Password">
                        </div>
                        @error('password')
                            <div class="text-danger my-1 text-sm" >
                                {{$message}}
                            </div>
                        @enderror
                        
                        <div class="form-group">
                            <input type="submit" class="form-control btn-primary">
                        </div> 
                        
                    
                    </form>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="card " style="width:32%;">
                <div class="card-body" >
                <p class="text-center" style="margin:0;">Your don't have an accont?<a href="{{route('register')}}" class="card-link">Register</a></p>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>